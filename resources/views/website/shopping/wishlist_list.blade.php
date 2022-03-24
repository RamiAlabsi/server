@foreach ($user_favourites as $user_favourite)
@php
$product = $user_favourite->productWithTrashed;
@endphp
<tr>
    <td class="product-thumbnail">
        <a href="{{ url('products/' . $product->id) }}" onclick="return {{ $product->trashed()?'false':'true' }};" >
            <img src="{{ $product->images[0]->image_url }}" alt="product1">
        </a>
    </td>
    <td class="product-name" data-title="Product">
        <a href="{{ url('products/' . $product->id) }}" onclick="return {{ $product->trashed()?'false':'true' }};">
            {{ $product->translation->name }}
        </a>
    </td>
    <td class="product-price" data-title="Price">{{ $product->final_price }}</td>
    <td class="product-stock-status" data-title="Stock Status">
        <span
            class="badge badge-pill badge-{{ $product->trashed()?"danger":"success" }}">@lang('lang.' . ($product->trashed()?"not_available":"available"))</span>
    </td>
    <td class="product-add-to-cart">
        <a href="{{ url('products/' . $product->id) }}" class="btn btn-fill-out"
            onclick="return {{ $product->trashed()?'false':'true' }};">
            <i class="icon-basket-loaded"></i>
            @lang('lang.add_to_cart')
        </a>
    </td>
    <td class="product-remove" data-title="Remove">
        <a onclick="removeFavourite($(this))" data-product_id="{{ $product->id }}">
            <i class="ti-close"></i>
        </a>
    </td>
</tr>
@endforeach