<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get()->toArray();
        return view('page.product-list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, Request $request)
    {
        $products = Product::find($id);
        $carts = session('cart',[]);
        if(isset($carts[$id])){
            $carts[$id]['quantity'] += 1;
        }else{
            $carts[$id] = [
                'name'  => $products->name,
                'desc'  => $products->description,
                'price' => $products->price,
                'image' => $products->image,
                'quantity' => 1
            ];
        }

        session()->put('cart',$carts);
        return redirect()->back()->with('success','Successful add shoes to cart.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('page.cart-list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // info($request->all());
        $cart = session('cart');

        if($request->type == 'update'){
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }else{
            unset($cart[$request->product_id]);
        }
        session()->put('cart',$cart);
        $view = view('page.cart-content')->render();
        return response()->json(['success' => $view]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => 1
        ]);

        $amount = 0;
        foreach(session('cart') as $key => $value){
            $order->products()->create([
                'product_id' => $key,
                'quantity' => $value['quantity'],
                'price' => $value['price']
            ]);

            $amount = $amount + ($value['price'] * $value['quantity']);
        }
        $order->amount = $amount;
        $order->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $successURL = route('order.success') .'?session_id={CHECKOUT_SESSION_ID}&order_id='. $order->id;
        $response = $stripe->checkout->sessions->create([
        'success_url' => $successURL,
        'customer_email' => 'motedee02@gmail.com',
        'line_items' => [
            [
            'price_data' => [
                'product_data' => [
                    'name' => 'Shipping'
                ],
                'unit_amount' => 100 * $amount,
                'currency' => 'USD'
            ],
            'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        ]);

        return redirect($response['url']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function orderSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        if($session->status == 'complete'){
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->stripe_id = $session->id;
            $order->save();
            return redirect()->route('home')->with('success','Successful completed order.');
        }
        $order = Order::find($request->order_id);
        $order->status = 2;
        $order->save();
        dump('Failed');

    }
}
