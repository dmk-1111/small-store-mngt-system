<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/product-list');
});

/**
 * Route GET
 */
Route::get('/product-list',[ProductController::class, 'index'])->name('home');
Route::get('/all-cart',[ProductController::class, 'show'])->name('view.all');
Route::get('/add-cart/{id}',[ProductController::class, 'create']);
Route::get('/order-success',[ProductController::class, 'orderSuccess'])->name('order.success');

/**
 * Route POST
 */
Route::post('/edit-cart',[ProductController::class, 'edit'])->name('edit.cart');
Route::post('/order-product',[ProductController::class, 'order'])->name('order.product');
