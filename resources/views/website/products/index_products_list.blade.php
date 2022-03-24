<div class="row shop_container list" id="productsListDiv">
    @forelse ($products as $product)
    <div class="col-lg-3 col-md-4 col-6">
        <div class="product">
            <div class="product_img">
                <a href="{{ url('products/'.$product->id) }}">
                    <img src="{{ url($product->images[0]->image_url) }}" alt="product_img1">
                </a>
                <div class="product_action_box">
                    <ul class="list_none pr_action_btn">
                        <li class="add-to-cart">
                            <a href="{{ url('products/'.$product->id) }}">
                                <i class="icon-basket-loaded disabled"></i>
                                @lang('lang.go_to_product')
                            </a>
                        </li>
                        {{-- <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li> --}}
                        {{-- <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a> --}}
                        </li>
                        @php
                        $favourite = in_array($product->id, $user_favourite_products);
                        $heart_active = $favourite?"active":"";
                        @endphp
                        <li><a onclick="toggleFavourite({{ $product->id }})"><i
                                    class="icon-heart {{ $heart_active }}"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="product_info">
                <h6 class="product_title">
                    <a href="{{ url('products/'.$product->id) }}">{{ $product->translation->name }}</a>
                </h6>
                <div class="product_price">
                    @if ($product->discount_rate == null)
                    <span class="price">{{ $product->price }}</span>
                    @else
                    <span class="price">{{ $product->price - ($product->price * $product->discount_rate) / 100 }}</span>
                    <del>{{ $product->price }}</del>
                    <div class="on_sale">
                        <span>{{ $product->discount_rate }}@lang('lang.percent_off_text')</span>
                    </div>
                    @endif
                </div>
                @if($product->showRate())
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width:{{ $product->rate_percentage }}%"></div>
                    </div>
                    {{-- <span class="rating_num">(21)</span> --}}
                </div>
                @endif
                <div class="pr_desc">
                    <p>{{ $product->translation->small_description }}</p>
                </div>
                <div class="pr_switch_wrap">
                    {{-- <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div> --}}
                </div>
                <div class="list_product_action_box">
                    <ul class="list_none pr_action_btn">
                        <li class="add-to-cart">
                            {{-- <a onclick="toggleCart({{ $product->id }})" class=""> --}}
                            <a href="{{ url('products/'.$product->id) }}" class="">
                                {{-- <i class="icon-basket-loaded">
                                    @php
                                    $not_in_cart = true;
                                    if(Auth::user() != null)
                                    $not_in_cart = \App\Models\Cart::where('user_id', Auth::user()->id)
                                    ->where('product_id', $product->id)->first() == null;
                                    @endphp
                                </i>
                                {{ $not_in_cart?"Add To":"Remove From" }} Cart --}}
                                @lang('lang.go_to_product')
                            </a>
                        </li>
                        {{-- <li><a href="shop-compare.html" class="popup-ajax"><i
                                                        class="icon-shuffle"></i></a></li> --}}
                        {{-- <li><a href="shop-quick-view.html" class="popup-ajax"><i
                                                        class="icon-magnifier-add"></i></a></li> --}}
                        <li>
                            <a onclick="toggleFavourite({{ $product->id }})">
                             <i class="icon-heart" id="heart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p>no products</p>
    @endforelse
</div>
<div class="row">
    <div class="col-12">
        <ul class="pagination mt-3 justify-content-center pagination_style1">
            @for ($i = 0; $i < $pages_cnt; $i++) <li class="page-item {{ ($i+1) == $page_num?"active":"" }}">
                <a class="page-link" onclick="getProductsList({{ $i+1 }})">{{ $i + 1 }}</a>
                </li>
                @endfor
        </ul>
    </div>
</div>