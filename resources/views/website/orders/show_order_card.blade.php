@php
$baseLocale = App::getLocale();
$product = $cart_item->product;
@endphp
{{ App::setLocale($language->locale) }}
<!-- Col -->
<div class="col-md-4 col-sm-12">
    <div class="pro-block">
        <div class="img-block">
            <a href="javascript:void(0)">
                <span class="sale-i">{{ $product->discount_rate }}@lang('lang.percent_off_text')</span>
                <img src="{{ url("{$product->images[0]->image_url}") }}" alt="#" />
            </a>
        </div>
        <div class="details-block">
            <a href="#" class="pro-name">{{ $product->translation->name }}</a>
            <div class="more-details row">
                <!-- Col -->
                <div class="col-md-6 col-sm-6">
                    <div class="item">
                        <span>@lang('lang.quantity')</span>
                        <h5>{{ $cart_item->quantity }}</h5>
                    </div>
                </div>
                <!-- /Col -->
                <!-- Col -->
                <div class="col-md-6 col-sm-6">
                    <div class="item">
                        <span>@lang('lang.price')</span>
                        <h5>
                            <span class="old-price">
                                {{ $product->price }}
                            </span>
                            <span class="new-price">
                                {{ $product->final_price }}
                            </span>
                        </h5>
                    </div>
                </div>
                <!-- /Col -->
                <!-- Col -->
                <div class="col-md-6 col-sm-6">
                    <div class="item">
                        <span>@lang('lang.status')</span>
                        <h5 class="delivered status_h5" data-order_item_id="{{ $order_item->id }}"></h5>
                    </div>
                </div>
                <!-- /Col -->
                <!-- Col -->
                <div class="col-md-6 col-sm-6">
                    <div class="item">
                        <span>@lang('lang.store_name')</span>
                        <h5>{{ $product->stores[0]->translation->name }}</h5>
                    </div>
                </div>
                <!-- /Col -->
                <!-- Col -->
                <div class="col-md-12 col-sm-12">
                    <div class="all-value">
                        <ul>
                            @foreach ($cart_item->attribute_selections as
                            $cart_attribute_selection)
                            <li>
                                @php
                                $allowed_value =
                                $cart_attribute_selection->selected_attribute_allowed_value;
                                @endphp
                                <span>{{ $allowed_value->product_attribute->translation->name }}</span>
                                <h3>{{ $allowed_value->translation->value }}</h3>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /Col -->
            </div>
        </div>
    </div>
</div>
<!-- /Col -->
{{ App::setLocale($baseLocale) }}