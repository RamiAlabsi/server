@foreach ($cart_items as $cart_item)
@php
    $product = $cart_item->product;
@endphp
<tr>
    <td class="product-thumbnail">
        <a href="{{ url("products/$product->id") }}">
            <img src="{{ url("{$product->images[0]->image_url}") }}" alt="product{{ $product->id }} image">
        </a>
    </td>
    <td class="product-name" data-title="Product">
        <a href="{{ url("products/$product->id") }}">{{ $product->translation->name }}</a>
    </td>
    <td class="product-price" data-title="Price">{{ $product->final_price }}</td>
    {{-- TODO: calculate the discount --}}
    <td class="product-quantity" data-title="Quantity">
        <div class="quantity">
            <input type="button" value="-" class="minus" onclick="changeQty({{ $product->id }}, 'minus', {{ $product->final_price }})">
            <input type="text" name="quantity" value="{{ $cart_item->quantity }}" id="product_{{ $product->id }}_qty"  title="Qty" class="qty" size="4" disabled>
            <input type="button" value="+" class="plus" onclick="changeQty({{ $product->id }}, 'plus', {{ $product->final_price }})">
        </div>
    </td>
    <td class="product-subtotal" id="product_{{ $product->id }}_subtotal" data-title="Total">{{ $product->final_price * $cart_item->quantity }}</td>
    <td class="product-remove" data-title="Remove">
        <a onclick="removeFromCart({{ $product->id }})"><i class="ti-close"></i></a>
    </td>
</tr>
@endforeach