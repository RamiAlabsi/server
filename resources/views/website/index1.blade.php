@extends('layouts.website_layout')

@section('content')
<!-- start categories -->
<section class="categories">
    <div class="img-fluid">
        <div class="row">
            <div class="col-md-3 side-menu">
                {{-- <a href="{{ url('/') }}">
                <img class="img-fluid" src="{{ URL::to('/') }}/public/images/Group 88.png">
                </a>
                <p class="all-categories">
                    <a class="btn" data-toggle="collapse" href="#all-categories" role="button" aria-expanded="false"
                        aria-controls="all-categories">
                        <i class="fas fa-bars"></i> جميع الفئات
                    </a>
                </p> --}}
                <div class="collapse" id="all-categories">
                    <div class="card card-body all-categories-card">
                        <ul class="category-menu">
                            <li data-toggle="collapse" href="#collapseExample1">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-ring"></i> الذهب والفضه
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample1">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample2">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-stethoscope"></i> أدوات وأجهزه طبيه
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample2">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample3">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-capsules"></i> الصيدليات و الأدوية
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample3">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample4">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="far fa-clock"></i> الساعات
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample4">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample5">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-glasses"></i> النظارات و العدسات
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample5">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample6">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-ring"></i> الذهب والفضه
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample6">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                            <li data-toggle="collapse" href="#collapseExample7">
                                <a class="btn" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-stethoscope"></i> أدوات وأجهزه طبيه
                                </a><i class="fas fa-angle-down"></i>
                                <div class="collapse" id="collapseExample7" style="background: white;">
                                    <div class="card card-body">
                                        <a href="#" class="btn">تصنيف 1</a>
                                        <a href="#" class="btn">تصنيف 3</a>
                                        <a href="#" class="btn">تصنيف 2</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                @if ($settings["index_sale_categories_main_on"])
                @php ($latest_updated_category = $latest_updated_category_sale->category)
                <div class="accessories">
                    <a
                        href="{{ url('products?category_id=' . $latest_updated_category->id . '&discount_rate=' . $latest_updated_category_sale->discount_rate) }}">
                        <div class="parent">
                            <img class="img-fluid" src="{{ url($latest_updated_category->image_url) }}">
                            <div class="content">
                                <p>{{ $latest_updated_category->translation->name }}</p>
                                <p><span>@lang('lang.offer')</span>
                                    <span>{{ $latest_updated_category_sale->discount_rate }}%</span></p>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                <div class="daily-deals">
                    <h1>@lang('lang.today_offers')</h1>
                    <hr>
                    @foreach ($today_offers_list as $product)
                    <div class="parent">
                        <a href="#" class="d-block">
                            <img class="img-fluid"
                            src="{{ url("{$product->images[0]->image_url}") }}">
                            <h5>{{ $product->translation->name }}</h5>
                            <p>{{ $product->final_price }} <bdi>@lang('lang.currency')</bdi></p>
                            {{-- <span>منتهية الصلاحية</span> --}}
                        </a>
                    </div>
                    @endforeach
                </div>

                @if ($settings["index_newest_products_section_on"])
                <div class="latest-products">
                    <h1>@lang('lang.newest_products')</h1>
                    <hr>
                    @foreach ($newest_products as $newest_product)
                    <div class="parent">
                        <a href="#" class="d-block">
                            <img class="img-fluid" src="{{ url("{$newest_product->images[0]->image_url}") }}">
                        <div class="details">
                            <h6>{{ $newest_product->translation->name }}</h6>

                            @if ($newest_product->discount_rate == null)
                            <span class="price">{{ $newest_product->price }}</span>
                            @else
                            <span
                                class="price">{{ $newest_product->price - ($newest_product->price * $newest_product->discount_rate) / 100 }}</span>
                            <del>{{ $newest_product->price }}</del>
                            <div class="on_sale">
                                <span>{{ $newest_product->discount_rate }} @lang('lang.percent_off_text')</span>
                            </div>
                            @endif

                            {{-- <span> <bdi>ريال</bdi></span> --}}
                            @if ($newest_product->showRate())
                            <p class="rating">
                                @for ($i=1; $i < 6; $i++)
                                    @if($i <= round($newest_product->total_rate))
                                        <i class="far fa-star rated"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </p>
                            @endif
                        </div>
                        </a>
                        
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="col-md-9 content">


                {{-- <div class="row search-row">
                    <div class="col-md-8 right-items">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                جميع الفئات <i class="fas fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">فئه 1</a>
                                <a class="dropdown-item" href="#">فئه 2</a>
                                <a class="dropdown-item" href="#">فئه 3</a>
                                <a class="dropdown-item" href="#">فئه 4</a>
                                <a class="dropdown-item" href="#">فئه 5</a>
                            </div>
                        </div>
                        <input class="form-control" type="text" placeholder="إبحث في الأقسام الخاصه بنا">
                        <button class="submit" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-md-4">
                        <p class="social">
                            <a href="{{ $settings['facebook_url'] }}" class="btn">
                <i class="fab fa-facebook-f"></i>
                </a>
                <a href="{{ $settings['twitter_url'] }}" class="btn">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="{{ $settings['instagram_url'] }}" class="btn">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="{{ $settings['snapchat_url'] }}" class="btn">
                    <i class="fab fa-snapchat-ghost"></i>
                </a>
                </p>
            </div>
        </div> --}}


        @if ($settings['index_features_on'] == 1)
        <div class="row features">
            <div class="col-md-4">
                <div class="parent parent-1">
                    <p><i class="{{ $settings['index_feature_icon1_class'] }}"></i>@lang('lang.index_features_text1')
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="parent parent-2">
                    <p><i class="{{ $settings['index_feature_icon2_class'] }}"></i>@lang('lang.index_features_text2')
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="parent parent-3">
                    <p><i class="{{ $settings['index_feature_icon3_class'] }}"></i>@lang('lang.index_features_text3')
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if ($settings['index_main_ad_section_on'] == 1)
        <div class="row black-friday" style="margin-bottom: 36px;">
            <div class="col-md-12">
                <img class="img-fluid" src="{{ url("{$settings['index_main_ad_url']}") }}">
            </div>
        </div>
        @endif
        @if ($settings["index_category_section_on"] == 1)
            <div class="row electronics">
                <div class="col-md-12">
                    <h1>{{ $last_updated_category->translation->name ?? '' }}</h1>
                    <hr>
                </div>
                <div class="col-md-12" style="direction: ltr;">
                    <div class="owl-carousel owl-theme main-carousel">
                        @if(!empty($last_updated_category->children))
                        @foreach ($last_updated_category->children as $category)
                        <div class="item">
                            <div class="parent">
                                <img class="img-fluid" src="{{ url("$category->image_url") }}">
                                <a href="{{ url("/products?category_id=" . $category->id) }}">
                                    <p>{{ $category->translation->name }}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="row choose-for-u">
            <div class="col-md-12">
                <h1>اخترنا لك</h1>
                <hr>
            </div>
            <div class="col-md-12" style="direction: ltr;">
                <div class="owl-carousel owl-theme main-carousel">
                    <div class="item">
                        <a href="#">
                            <div class="parent">
                                <img class="img-fluid"
                                    src="{{ URL::to('/') }}/public/images/stock-photo-confident-in-his-style-full-length-of-good-looking-young-man-keeping-hand-in-pocket-and-looking-at-720914785.png">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <p>250.00 <bdi>ريال</bdi></p>
                                <p class="rating">
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                                <span>جديد</span>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <div class="parent">
                                <img class="img-fluid" src="{{ URL::to('/') }}/public/images/t-shirts-product.png">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <p>250.00 <bdi>ريال</bdi></p>
                                <p class="rating">
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                                <span>جديد</span>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <div class="parent">
                                <img class="img-fluid"
                                    src="{{ URL::to('/') }}/public/images/Perfume-Elegant-Shalimar-PNG-Photo.png">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <p>250.00 <bdi>ريال</bdi></p>
                                <p class="rating">
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                                <span>جديد</span>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <div class="parent">
                                <img class="img-fluid" src="{{ URL::to('/') }}/public/images/Image 7.png">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <p>250.00 <bdi>ريال</bdi></p>
                                <p class="rating">
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star rated"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                                <span>جديد</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
        @if ($settings['index_sub_ad_section_on'])
        <div class="row offers">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ url("{$settings['index_sub_ad1_url']}") }}">
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="{{ url("{$settings['index_sub_ad2_url']}") }}">
            </div>
        </div>
        @endif
        @if ($settings["index_categories_section_on"])
        <div class="row explore">
            <div class="col-md-12">
                <h1>@lang('lang.browse_categories')</h1>
                <hr>
            </div>
            <div class="col-md-12" style="direction: ltr;">
                <div class="owl-carousel owl-theme main-carousel">
                    @foreach ($last_updated_categories as $one_last_updated_category)
                    <div class="item">
                        <a href="{{ url('products?category_id=' . $one_last_updated_category->id) }}">
                            <div class="parent">
                                <img class="img-fluid" src="{{ url("$one_last_updated_category->image_url") }}">
                                <p>{{ $one_last_updated_category->translation->name }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="row best-seller">
            <div class="col-md-12">
                <h1>@lang('lang.best_seller')</h1>
                <hr>
            </div>
            <div class="col-md-12" style="direction: ltr;">
                <div class="owl-carousel owl-theme main-carousel">
                    @foreach ($best_seller_list as $product)
                    <div class="item">
                        <a href="{{ url("products/$product->id") }}">
                            <div class="parent">
                                <img class="img-fluid"
                                    src="{{ url("{$product->images[0]->image_url}") }}">
                                <h6>{{ $product->translation->name }}</h6>
                                <p>{{ $product->final_price }} <bdi>@lang('lang.currency')</bdi></p>
                                @if ($product->showRate())
                                <p class="rating">
                                    @for ($i=1; $i < 6; $i++)
                                        @if($i <= round($product->total_rate))
                                            <i class="far fa-star rated"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </p>
                                @endif
                                {{-- <span>جديد</span> --}}
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- end categories -->
<!-- start discounts -->
@if ($settings["index_sale_categories_section_on"] == 1)
<section class="discounts">
    <div class="container-fluid">
        <div class="row">
            <div class="owl-carousel owl-theme" id="discounts">
                @foreach ($category_sales as $category_sale)
                <div class="item">
                    <a
                        href="{{ url('products?category_id=' . $category_sale->category->id . '&discount_rate=' . $category_sale->discount_rate) }}">
                        <div class="parent">
                            <img class="img-fluid" src="{{ url("{$category_sale->category->image_url}") }}">
                            <div class="content">
                                <p>{{ $category_sale->category->translation->name }}</p>
                                <p><span>@lang('lang.offer')</span> <span>{{ $category_sale->discount_rate }}%</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- end discounts -->
<!-- start electronics-section -->
<section class="electronics-section">
    <div class="container-fluid">
        @if($last_updated_category != null)
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $last_updated_category->translation->name }}</h1>
                <hr>
            </div>
            <div class="col-md-12" style="direction: ltr;">
                <div class="owl-carousel owl-theme" id="electronics-section">
                    @foreach ($last_updated_category->products as $product)
                    <div class="item">
                        <a href="{{ url('products/' . $product->id) }}">
                            <div class="parent">
                                <img class="img-fluid" src="{{ url("{$product->images[0]->image_url}") }}">
                                <h6>{{ $product->translation->name }}</h6>
                                {{-- <p>250.00 <bdi>ريال</bdi></p> --}}
                                @if ($product->discount_rate == null)
                                <p>{{ $product->price }}</p>
                                @else
                                <p>{{ $product->price - ($product->price * $product->discount_rate) / 100 }}</p>
                                @endif
                                @if ($product->showRate())
                                <p class="rating">
                                    @for ($i=1; $i < 6; $i++)
                                        @if($i <= round($product->total_rate))
                                            <i class="far fa-star rated"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </p>
                                @endif
                                @if ($product->discount_rate != null)
                                <span>{{ $product->discount_rate }} @lang('lang.percent_off_text')</span>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- end electronics-section -->
@endsection

@section('additional_scripts')
<script>
    // collapse side menu
    $('.all-categories').on('click', function () {
        if ( $('#all-categories').hasClass('show') ) {
            $('.all-categories').css('background', 'none');
        } else {
            $('.all-categories').css('background', ' #f3f3f3');
        }
    })

    // discounts carousel
    $('#discounts').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:1500,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:4,
                nav:false
            }
        }
    })

    // best-seller carousel & choose-for-u carousel & explore carousel
    $('.main-carousel').owlCarousel({
        loop:true,
        margin:13,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:4,
                nav:false
            }
        }
    })

    // electronics carousel
    $('#electronics-section').owlCarousel({
        loop:true,
        margin:18,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:5,
                nav:false
            }
        }
    })

    // rating stars
    $(window).on('load', function () {
        $('p.rating i.rated').removeClass('far fa-star');
        $('p.rating i.rated').addClass('fas fa-star');
    })
</script>
@endsection