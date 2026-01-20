<table class="table table-cart mt-4">
    <thead>
        <tr class="fs-3">
            <th>Image</th>
            <th>Name</th>
            <th style="width: 90px;">QTY</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @if (session('cart'))
            @foreach (session('cart', []) as $key => $value)
                @php
                    $total = $total + ($value['price'] * $value['quantity'] ?? 0);
                @endphp
                <tr data-id="{{ $key }}">
                    <td>
                        <img src="{{ asset('uploads/'.$value['image'] ?? '') }}" width="100px" alt="img">
                    </td>
                    <td class="fs-4">
                        {{ $value['name'] ?? null }}
                    </td>
                    <td class="fs-4">
                        <input type="number" name="quantity" class="form-control quantity"
                            value="{{ $value['quantity'] ?? null }}" min="1">
                    </td>
                    <td class="fs-4">
                        <span class="badge bg-danger">${{ $value['price'] * $value['quantity'] ?? 0 }}</span>
                    </td>
                    <td class="fs-4">
                        <i class="ri-delete-bin-line fs-2 text-danger btn-del" title="Delete"></i>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">
                    <h4 class="text-center">Empty cart.</h4>
                </td>
            </tr>
        @endif
        <tr>
            <td colspan="5" class="text-end bg-light">
                <h4 class="m-0">Total: ${{ $total }}</h4>
            </td>
        </tr>
    </tbody>
</table>
