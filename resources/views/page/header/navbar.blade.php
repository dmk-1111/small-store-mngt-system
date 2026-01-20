<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-3" style="background-color: #282828;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/"><i class="ri-shopping-bag-2-fill"></i> Shoes Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle btn btn-success text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My cart ({{ count(session('cart',[])) }})
          </a>
          <ul class="dropdown-menu p-0 shadow-sm" aria-labelledby="navbarDropdown">
            @if(session('cart',[]))
                @foreach (session('cart',[]) as $key => $value )
                    <li class="{{ $key > 0 ? 'border-bottom' : '' }}">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('uploads/'.$value['image'] ?? '') }}" width="50px" alt="">
                            </div>
                            <div class="col-md-8 p-0">
                                <p class="m-0"><strong>{{ $value['name'] ?? null }}</strong></p>
                                <span>Price: {{ $value['price'] * $value['quantity'] ?? null }}</span>
                                <span>Qty: {{ $value['quantity'] ?? null }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <p class="text-center pt-3">Empty cart.</p>
            @endif
            <div class="bg-light">
                <div class="w-100 d-flex justify-content-center p-2">
                    <a href="{{ route('view.all') }}" class="btn btn-info">View All</a>
                </div>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
