@extends('index')
@section('content')
    @session('success')
        <div class="alert alert-success m-0 mt-4 d-flex align-items-center" role="alert">
            <i class="ri-check-line fs-4"></i>
            &nbsp;
            <h5 class="m-0">{{ $value }}</h5>
        </div>
    @endsession
    <div class="row card-group">
        @foreach ($products ?? [] as $p)
            <div class="col col-md-4 rounded">
                <div class="card mt-4 mb-4 shadow-sm">
                    <img src="{{ asset('uploads/'.$p['image']) }}" class="card-img-top" alt="...">
                    <div class="card-body bg-light">
                        <h5 class="card-title">{{ $p['name'] ?? [] }}</h5>
                        <p class="card-text">{{ $p['description'] ?? [] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text m-0"><span class="badge bg-danger fs-5">${{ $p['price'] ?? [] }}</span></p>
                            <a href="{{ url('/add-cart/'.$p['id']) }}" class="btn btn-primary" title="Add to cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.card-img-top').forEach(img => {
            img.addEventListener('mouseover', function () {
                this.style.transform = 'scale(0.95)';
                this.style.transition = '.2s all';
            });

            img.addEventListener('mouseout', function () {
                this.style.transform = 'scale(1)';
                this.style.transition = '.2s all';
            });
        });
    </script>
@endsection
