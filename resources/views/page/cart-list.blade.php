@extends('index')
@section('content')
    <form action="{{ route('order.product') }}" method="POST">
        @csrf
        <div class="row" id="cart-products">
            @include('page.cart-content')
        </div>
        <div class="text-end">
            <a href="/" class="btn btn-warning">Continue Shopping</a>
            <button class="btn btn-success" type="submit">Checkout</button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(() => {
            // Use event delegation
            $('#cart-products').on('change', '.quantity', function () {
                let elem = $(this);

                $.ajax({
                    url: "{{ route('edit.cart') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: elem.closest('tr').data('id'),
                        type:'update',
                        quantity: elem.val()
                    },
                    success: function (res) {
                        $('#cart-products').html(res.success);
                    }
                });
            });

            $('body').on('click', '.btn-del', function () {
                let elem = $(this);
                $.ajax({
                    url: "{{ route('edit.cart') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: elem.closest('tr').data('id'),
                        type:'delete',
                        quantity: elem.val()
                    },
                    success: function (res) {
                        $('#cart-products').html(res.success);
                    }
                });
            });
        });
    </script>
@endsection


