@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="product_img_box">
                            <img id="product_img" src='{{  url($product->images[0]->image_url)  }}'
                                data-zoom-image="{{  url($product->images[0]->image_url)  }}" alt="product_img1" />
                            <a href="#" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4"
                            data-slides-to-scroll="1" data-infinite="false">
                            @foreach ($product->images as $image)
                            <div class="item">
                                <a href="#" class="product_gallery_item active"
                                    data-image="{{  url($image->image_url)  }}"
                                    data-zoom-image="{{  url($image->image_url)  }}">
                                    <img src="{{  url($image->image_url)  }}" alt="product_small_img1" />
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6" style="text-align: start;">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title"><a href="#">{{ $product->translation->name }}</a></h4>
                            <div class="main_product_price">

                            </div>
                            @if($product->showRate())
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:{{ $product->rate_percentage }}%"></div>
                                </div>
                                {{-- <span class="rating_num">(21)</span> --}}
                            </div>
                            @endif
                            <br>
                            <div class="pr_desc">
                                <p>{{ $product->translation->small_description }}</p>
                            </div>
                            <div class="product_sort_info">
                                <ul>
                                    {{-- <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty
                                    </li>
                                    <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                                    <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li> --}}
                                </ul>
                            </div>
                            {{-- <div class="pr_switch_wrap">
                                <span class="switch_lable">Color</span>
                                <div class="product_color_switch">
                                    <span class="active" data-color="#87554B"></span>
                                    <span data-color="#333333"></span>
                                    <span data-color="#DA323F"></span>
                                </div>
                            </div>
                            <div class="pr_switch_wrap">
                                <span class="switch_lable">Size</span>
                                <div class="product_size_switch">
                                    <span>xs</span>
                                    <span>s</span>
                                    <span>m</span>
                                    <span>l</span>
                                    <span>xl</span>
                                </div>
                            </div> --}}
                        </div>
                        <hr />
                        <div class="cart_extra">
                            @foreach ($product->attributes as $key => $attribute)
                            <div class="col-md-4">{{ $attribute->translation->name }} </div>
                            @php
                            $selected_allowed_value_id = $cart_item == null? 0 :
                            $cart_item->attribute_selections[$key]->selected_attribute_allowed_value->id;
                            @endphp
                            <div class="col-md-8">
                                <select class="allowed_values_select" required data-prev="0" name="attributes[]"
                                    {{ $cart_item != null? "disabled" : "" }}>
                                    @if ($selected_allowed_value_id == null)
                                    <option selected disabled></option>
                                    @endif
                                    @foreach ($attribute->allowed_values as $allowed_value)
                                    <option value="{{ $allowed_value->id }}" data-price="{{ $allowed_value->price }}"
                                        {{ $selected_allowed_value_id == $allowed_value->id?"selected":""}}>
                                        {{ $allowed_value->translation->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
                        <hr />
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus"
                                        {{ $cart_item != null? "disabled" : "" }}>
                                    <input type="text" id="quantity_input" name="quantity"
                                        value="{{ $cart_item == null? 1:$cart_item->quantity }}" title="Qty" class="qty"
                                        size="4" {{ $cart_item != null? "disabled" : "" }}>
                                    <input type="button" value="+" class="plus"
                                        {{ $cart_item != null? "disabled" : "" }}>
                                </div>
                            </div>

                            <div class="cart_btn">
                                <button class="btn btn-fill-out btn-addtocart" onclick="addToCart({{ $product->id }})"
                                    type="button" id="add_to_cart_button">
                                    <i class="icon-basket-loaded"></i>
                                    {{ app('translator')->get($cart_item == null?'lang.add_to':'lang.remove_from') }} @lang('lang.cart')
                                </button>
                                {{-- <a class="add_compare" href="#"><i class="icon-shuffle"></i></a> --}}
                                @php
                                $favourite = in_array($product->id, $user_favourite_products);
                                $heart_active = $favourite?"active":"";
                                @endphp
                                <a class="add_wishlist" onclick="toggleFavourite({{ $product->id }})"><i
                                        class="icon-heart {{ $heart_active }}"></i></a>
                            </div>
                        </div>
                        <hr />
                        <div class="cart_extra">
                            <div class="cart_btn">
                                <form action="{{ url(app()->getLocale() . "/products/" . $product->id . "/request") }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="qty" id="request_qty" value="1">
                                    <label for="request_price">@lang('lang.request_price'):</label>
                                    <input type="number" name="request_price" step="0.01">
                                    <button class="btn btn-fill-out btn-addtocart" type="submit" id="request_button" {{ Auth::user() == null?"disabled":"" }}>
                                        @lang('lang.make_request')
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <ul class="product-meta">
                            {{-- <li>SKU: <a href="#">BE45VGRT</a></li> --}}
                            <li>@lang('lang.categories'):
                                @for ($i = 0; $i < count($product->categories); $i++)
                                    {{-- <a href="#">{{ $product->categories[$i]->translation->name }}</a> --}}
                                    {{ $product->categories[$i]->translation->name }}
                                    @if (($i + 1) != count($product->categories))
                                    @lang('lang.colon')
                                    @endif
                                    @endfor

                            </li>
                            {{-- <li>Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">printed</a> </li> --}}
                        </ul>

                        {{-- <div class="product_share">
                            <span>Share:</span>
                            <ul class="social_icons">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3" style="text-align: start;">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description"
                                    role="tab" aria-controls="Description"
                                    aria-selected="true">@lang('lang.description')</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info"
                                    role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                            </li>  --}}
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab"
                                    aria-controls="Reviews" aria-selected="false">@lang('lang.reviews') (000)</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel"
                                aria-labelledby="Description-tab">
                                <p>{{ $product->translation->description }}</p>
                            </div>
                            {{-- <div class="tab-pane fade" id="Additional-info" role="tabpanel"
                                aria-labelledby="Additional-info-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Capacity</td>
                                        <td>5 Kg</td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td>Black, Brown, Red,</td>
                                    </tr>
                                    <tr>
                                        <td>Water Resistant</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Material</td>
                                        <td>Artificial Leather</td>
                                    </tr>
                                </table>
                            </div> --}}
                            <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                                <div class="comments">
                                    {{-- <h5 class="product_tab_title">2 Review For <span>Blue Dress For Woman</span>
                                    </h5> --}}
                                    <ul class="list_none comment_list mt-4">
                                        @foreach ($product->reviews as $review)
                                        <li>
                                            {{-- <div class="comment_img">
                                                <img src="{{ URL::to('/') }}/public/assets/images/user1.jpg"
                                            alt="user1" />
                                </div> --}}
                                <div class="comment_block">
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:{{ $review->rate_percentage }}%">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="customer_meta">
                                        <span class="review_author">{{ $review->user->name }}</span>
                                        <span
                                            class="comment-date">{{ date("d-m-Y", strtotime($review->created_at)) }}</span>
                                    </p>
                                    <div class="description">
                                        <p>{{ $review->text }}</p>
                                    </div>
                                </div>
                                </li>
                                @endforeach
                                </ul>
                            </div>
                            @if (Auth::user() != null)
                            <div class="review_form field_form">
                                <h5>@lang('lang.add_review')</h5>
                                <form class="row mt-3"
                                    action="{{ url(app()->getLocale() . "/products/$product->id/leaveReview") }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group col-12">
                                        <input type="hidden" id="rating_input" name="rating" value="0">
                                        <div class="star_rating">
                                            <span data-value="1"><i class="far fa-star"></i></span>
                                            <span data-value="2"><i class="far fa-star"></i></span>
                                            <span data-value="3"><i class="far fa-star"></i></span>
                                            <span data-value="4"><i class="far fa-star"></i></span>
                                            <span data-value="5"><i class="far fa-star"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <textarea required="required" placeholder="@lang('lang.review')..."
                                            class="form-control" name="text" rows="4" required></textarea>
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                            <input required="required" placeholder="Enter Name *" class="form-control"
                                                name="name" type="text">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input required="required" placeholder="Enter Email *" class="form-control"
                                                name="email" type="email">
                                        </div> --}}

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-fill-out"
                                            value="Submit">@lang('lang.submit')</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="small_divider"></div>
                <div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="heading_s1">
                    <h3>@lang('lang.related_products')</h3>
                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20"
                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    @foreach ($related_products as $related_product)
                    <div class="item">
                        <div class="product">
                            <div class="product_img">
                                <a href="{{ url('products/' . $related_product->id) }}">
                                    <img src="{{ url($related_product->images[0]->image_url) }}" alt="product image">
                                </a>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a
                                        href="{{ url('products/' . $related_product->id) }}">{{ $related_product->translation->name }}</a>
                                </h6>
                                <div class="product_price">
                                    @if ($related_product->discount_rate == 0)
                                    <span class="price">{{ $related_product->price }}</span>
                                    @else
                                    <span class="price">{{ $related_product->final_price }}</span>
                                    <del>{{ $related_product->price }}</del>
                                    <div class="on_sale">
                                        <span>{{ $related_product->discount_rate }}@lang("lang.percent_off_text")</span>
                                    </div>
                                    @endif
                                </div>
                                @if ($related_product->showRate())
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate"
                                            style="width:{{ $related_product->rate_percentage }}%">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="pr_desc">
                                    <p>{{ $related_product->translation->small_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END SECTION SHOP -->
</div>
@endsection


@section('additional_scripts')
<!-- ajax code -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function toggleFavourite(product_id){
        $.ajax({
            type: 'POST',
            url: "{{ url(app()->getLocale() . '/ajax/favourites/toggle') }}",
            data: {
                _token:"{{ csrf_token() }}",
                product_id: product_id
            },
            success: function(data) {
                // if('not_signed_in')
                // else if('removed_fav')
                // else if('added_to_fav')
                console.log(data);
            },
            error: function(data) {
                console.log('error');
                console.log(data);
            }
        });
    }
    function addToCart(product_id){
        var all_filled = true;
        var attribute_values = [];
        $('.allowed_values_select').each(function() {
            attribute_values.push($(this).val());
            if($(this).val() == null || $(this).val() == "")
                all_filled = false;
        });
        if(all_filled){
            var quantity = document.getElementById('quantity_input').value;
            $.ajax({
                type: 'POST',
                url: "{{ url(app()->getLocale() . '/ajax/cart/toggle') }}",
                data: {
                    _token:"{{ csrf_token() }}",
                    product_id: product_id,
                    quantity: quantity,
                    attribute_values: attribute_values
                },
                success: function(data) {
                    console.log('product added to log successfully');
                    var btn = document.getElementById("add_to_cart_button");
                    if(data == "added to cart"){
                        btn.innerText = "@lang('lang.remove_from_cart')";
                        $(".plus, .qty, .minus, .allowed_values_select").attr('disabled', true);
                    }
                    else{
                        btn.innerText = "@lang('lang.add_to_cart')";
                        $(".plus, .qty, .minus, .allowed_values_select").attr('disabled', false);
                    }
                    console.log(data);
                },
                error: function(data) {
                    console.log('error');
                    console.log(data);
                }
            });
        }
        else{
            alert("@lang('lang.fill_fields')");
        }
    }
    
    var discount = {{ $product->discount_rate }};
    var initial_price = {{ $product->price }};
    function calculatePrice(){
        var price = initial_price;
        $('.allowed_values_select').each(function(){
            var attribute_additional_price = $(this).children(':selected').data('price');
            attribute_additional_price = attribute_additional_price == null? 0 : attribute_additional_price;
            price += attribute_additional_price;
        });
        return price;
    }
    function setPrice(){
        var price = calculatePrice();
        var html = '';
        if(discount == 0){
            html = '<span class="price">' + price + '</span>';
            $('input[name ="request_price"]').val(price * $('#quantity_input').val());
        }
        else{
            total = price - (price * discount)/100;
            html = '\
                <span class="price">' + total + '</span>\
                <del>' + price + '</del>\
                <div class="on_sale">\
                    <span>' + discount + '@lang("lang.percent_off_text")</span>\
                </div>';
            $('input[name ="request_price"]').val(total * $('#quantity_input').val());
        }
        $('.main_product_price').html(html);
    }
    setPrice();
    $('.allowed_values_select').change(setPrice);
</script>
<script>
    $('#quantity_input').on('change', function(){
        var price = calculatePrice();
        price = price - (price * discount) / 100;
        
        var qty = parseInt($(this).val());
        $('input[name ="request_price"]').val(qty * price);
        $('#request_qty').val(qty);
    })
</script>
<script>
    $('.star_rating').on('click', function(){
        var stars_num = $(this).children("span.selected").length;
        $("#rating_input").val(stars_num);
    })
</script>
@endsection