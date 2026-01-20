<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">{{ __('Product Details') }}</h3>
                <button class="btn btn-primary float-right" onclick="window.history.back()">{{ __('Back') }}</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>{{ __('No') }}</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Description') }}</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Price') }}</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    width="100">
                            @else
                                {{ __('No Image') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Created By') }}</th>
                        <td>{{ $product->CreatedByName }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated By') }}</th>
                        <td>{{ $product->UpdatedByName }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
