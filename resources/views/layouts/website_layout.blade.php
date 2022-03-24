@php
$settings = [];
foreach (\App\Models\Setting::all() as $settings_obj)
    $settings[$settings_obj->key] = $settings_obj->value;
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
   <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="@lang('lang.author')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@lang('lang.description')">
    <meta name="keywords" content="@lang('lang.keywords')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
     <link rel="icon" href="{{url('/')}}/{{$settings['site_icon']}}"  sizes="16x16">
    <!-- vendor styles -->
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/FontAwesome/all.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/FontAwesome/all.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/owl.carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/owl.carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/vendor/animate.css/animate.css">

    <!-- main style -->
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/style.css">

    <!-- remove comment for (ltr) -->
      @if(app()->getLocale() == 'en')
     <link rel="stylesheet" href="{{url('/')}}/public/assets/css/style-ltr.css"> 

     @endif
</head>

<body>
    <!--==================== start navtop =======================-->
    <section class="navtop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 settings">
                    <div class="country">
                        <span>@lang('lang.country')<i class="fal fa-chevron-down"></i></span>
                        <div class="drop-countries">
                            <ul>
                            @foreach (\App\Models\Country::all() as $country)
                                <li class="item">
                                    <a href="#"><img src="{{url('/')}}/{{$country->img}}" alt="flag">{{$country->translation->name}}</a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                      @if(app()->getLocale() =='ar')
                    <a href="{{ str_replace(strtolower('/' . app()->getLocale()), '/en' , Request::fullUrl()) }}" class="lang"><i class="fal fa-globe"></i>English</a>
                    @else
                    <a href="{{ str_replace(strtolower('/' . app()->getLocale()), '/ar', Request::fullUrl()) }}" class="lang"><i class="fal fa-globe"></i>العربية</a>
                    @endif

                    <a href="{{route('vendor')}}" class="main-btn main">@lang('lang.Wholesale')</a>
                </div>
                <div class="col-md-6 auth">
                    <span>@lang('lang.contact with us')</span>
                    <span class="break">|</span>
                    <div class="sochial-media">
                    @if ($settings["social1_on"])
                            <a href="{{ $settings['social1_url'] }}">
                                <i class="{{ $settings['social1_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social2_on"])
                            <a href="{{ $settings['social2_url'] }}">
                                <i class="{{ $settings['social2_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social3_on"])
                            <a href="{{ $settings['social3_url'] }}">
                                <i class="{{ $settings['social3_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social4_on"])
                            <a href="{{ $settings['social4_url'] }}">
                                <i class="{{ $settings['social4_icon'] }}"></i>
                            </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End navtop =======================-->

    <!--==================== start navbar =======================-->
    <nav class="nav-menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 logo">
                    <a href="{{url('/')}}"><img src="{{url('/')}}/{{$settings['site_logo']}}" alt="@lang('lang.title')"></a>
                </div>
                <div class="col-md-6 search-div">
                <form action="{{ url(app()->getLocale() . '/products') }}" method="post">
                @csrf
                    <div class="search_input">
                        <select name="category_id" id="">
                        <option selected value="0">@lang('lang.all_categories')</option>
                                @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->translation->name }}</option>
                                @endforeach
                        </select>
                        <input type="search" placeholder="@lang('lang.search in category')" class="form-control" name="search_text"
                                required>
                        <div  type="submit" class="icon-search"><i class="fas fa-search"></i></div>
                        </div>
                        </form>
                    </div>
                
                <div class="col-md-3 additionals">
                    <div>
                    @if(Auth::check())
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dLabel">
                                <div class="icon_user"><i class="fal fa-user-alt"></i></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="{{ url('my_account') }}"><i class="fal fa-user-alt"></i>@lang('lang.my_account')</a>
                                @if (Auth::user()->isAdmin || Auth::user()->isVendor)
                                <a class="dropdown-item" href="{{ route('vendor') }}">
                                    @lang('lang.vendor_panel')
                                </a>
                                @endif
                                @if (Auth::user()->isAdmin)
                                <a class="dropdown-item" href="{{ url('admin/') }}">
                                    @lang('lang.admin_panel')
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('chat') }}"><i class="fal fa-user-alt"></i>@lang('lang.chat')</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> @lang('lang.logout')</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                              
                            </div>
                        </div>
                        <a href="{{ url('wishlist') }}" class="fav icon">
                            <i class="fal fa-heart"></i>
                            <!-- <span class="num">1</span> -->
                        </a>
                        <a href="{{ url('/cart') }}" class="cart icon">
                            <i class="fal fa-shopping-cart"></i>
                            @if(count(Auth::user()->cart_items) >0)
                            <span class="num">{{ count(Auth::user()->cart_items) }}</span>
                            @endif
                        </a>
                        @else
                      <div class="before_login">
                          <a class="main-btn animated text-center" href="login">@lang('lang.login')</a>
                      </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--==================== End navbar =======================-->

@if(isset($main) and  $settings['index_side_category_on'] == 1)
    <!--==================== start bottom_header =======================-->
    <div class="bottom_header light_skin main_menu_uppercase bg_dark mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                    <div class="categories_wrap">
                        <button type="button" data-target="#navCatContent" aria-expanded="false" class="categories_btn collapsed">
                            <i class="fal fa-bars"></i><span>@lang('lang.all_categories')</span>
                        </button>
                        <div id="navCatContent" class="nav_cat navbar collapse">
                            <ul>
                                @foreach(\App\Models\Setting::where('key','index_side_category_on')->first()->cats as $cat)
                              
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-item nav-link dropdown-toggler" href="#" data-toggle="dropdown">@if($cat->Cat->icon !=null)<i class="{{$cat->Cat->icon}}"></i>@endif <span>{{$cat->Cat->translation->name}}</span></a>
                                    @if($cat->Cat->id!=$cat->Cat->parent_id)
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-7">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-6">
                                                        <ul>
                                                            <li class="dropdown-header">منتجات مميزة</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-6">
                                                        <ul>
                                                            <li class="dropdown-header">منتجات مشهورة</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-5">
                                                <div class="header-banner2">
                                                    <img src="{{url('/')}}/public/assets/img/menu_banner1.jpg" alt="menu_banner1">
                                                    <div class="banne_info">
                                                        <h6>10% خصم</h6>
                                                        <h4>عرض جديد</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                                <div class="header-banner2">
                                                    <img src="{{url('/')}}/public/assets/img/menu_banner2.jpg" alt="menu_banner2">
                                                    <div class="banne_info">
                                                        <h6>15% خصم</h6>
                                                        <h4>ملابس رجالي</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-4">
                                                <ul>
                                                    <li class="dropdown-header">نسائي</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-4">
                                                <ul>
                                                    <li class="dropdown-header">رجالي</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-4">
                                                <ul>
                                                    <li class="dropdown-header">اطفال</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">اسم المنتج</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                                <li>
                                    <ul class="more_slide_open" style="display: none;">
                                        <li><a class="dropdown-item nav-link nav_item" href="login.html"><i class="fal fa-feather-alt"></i><span>اخري</span></a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="register.html"><i class="fal fa-feather-alt"></i> <span>اخري</span></a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="404.html"><i class="fal fa-feather-alt"></i><span>اخري</span></a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="coming-soon.html"><i class="fal fa-feather-alt"></i> <span>اخري</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="more_categories">@lang('lang.more_categories')</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false"> 
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="nav-link active" href="{{url('/')}}">@lang('lang.home')</a>

                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.pages')</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="about.html">من نحن</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.products')</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Woman's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vestibulum sed</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Men's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur laoreet</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Kid's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Accessories</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="d-lg-flex menu_banners">
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <img src="{{url('/')}}/public/assets/img/menu_banner1.jpg" alt="menu_banner1">
                                                    <div class="banne_info">
                                                        <h6>10% خصم</h6>
                                                        <h4>New Arrival</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <img src="{{url('/')}}/public/assets/img/menu_banner2.jpg" alt="menu_banner2">
                                                    <div class="banne_info">
                                                        <h6>15% خصم</h6>
                                                        <h4>Men's Fashion</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                              
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.store')</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Shop Page Layout</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Other Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Cart</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Checkout</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Wishlist</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">compare</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Order Completed</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Product Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Default</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Thumbnails Left</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <div class="header_banner">
                                                    <div class="header_banner_content">
                                                        <div class="shop_banner">
                                                            <div class="banner_img overlay_bg_40">
                                                                <img src="{{url('/')}}/public/assets/img/shop_banner2.jpg" alt="shop_banner2">
                                                            </div>
                                                            <div class="shop_bn_content">
                                                                <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                                <h5 class="text-uppercase shop_title">Sale 30% خصم</h5>
                                                                <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">تسوق الان</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="nav-link nav_item" href="contact.html">@lang('lang.contact with us')</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay_gen"></div>
    <!--==================== End bottom_header =======================-->
@else
  <!--==================== start bottom_header =======================-->
    <div class="bottom_header light_skin main_menu_uppercase bg_dark mb-4 header_2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false"> 
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="nav-link active" href="{{url('/')}}">@lang('lang.home')</a>

                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.pages')</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="about.html">من نحن</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">تواصل معنا</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.products')</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Woman's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vestibulum sed</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Men's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur laoreet</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Kid's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Accessories</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="d-lg-flex menu_banners">
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <img src="assets/img/menu_banner1.jpg" alt="menu_banner1">
                                                    <div class="banne_info">
                                                        <h6>10% خصم</h6>
                                                        <h4>New Arrival</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <img src="assets/img/menu_banner2.jpg" alt="menu_banner2">
                                                    <div class="banne_info">
                                                        <h6>15% خصم</h6>
                                                        <h4>Men's Fashion</h4>
                                                        <a href="#">تسوق الان</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">@lang('lang.store')</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Shop Page Layout</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Other Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Cart</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Checkout</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Wishlist</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">compare</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Order Completed</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Product Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Default</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Thumbnails Left</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <div class="header_banner">
                                                    <div class="header_banner_content">
                                                        <div class="shop_banner">
                                                            <div class="banner_img overlay_bg_40">
                                                                <img src="assets/img/shop_banner2.jpg" alt="shop_banner2">
                                                            </div>
                                                            <div class="shop_bn_content">
                                                                <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                                <h5 class="text-uppercase shop_title">Sale 30% خصم</h5>
                                                                <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">تسوق الان</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="nav-link nav_item" href="contact.html">@lang('lang.contact with us')</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay_gen"></div>
    <!--==================== End bottom_header =======================-->

@endif

 <!-- START MAIN CONTENT -->

    @yield('content');

    <!-- START SECTION SUBSCRIBE NEWSLETTER -->


   <!--==================== Start News Letter =======================-->
    <section class="news_letter">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="text">
                            <p>@lang('lang.Subscribe to our newsletter') <br> @lang('lang.And receive exclusive offers every week')</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{route('subscripe_newsletter')}}" method="post">
                        @csrf
                            <input type="email" name="email" placeholder="@lang('lang.Enter your email here')">
                            <button type="submit" class="main-btn animated">@lang('lang.Subscribe Now')</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--==================== End News Letter =======================-->




  <!--==================== Start Footer =======================-->
    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="site_info">
                    <a href="{{url('/')}}" class="logo"><img src="{{url('/')}}/{{$settings['site_logo_footer']}}" alt="@lang('lang.ffoter')"></a>
                    @if($settings["footer_small_description_on"])
                    <p>@lang('lang.about_us_small_description')</p>
                    @endif
                    <div class="con">
                    @if($settings["footer_email_on"])
                        <a href="mailto:youremailaddress" class="item">
                            <i class="fal fa-envelope"></i>
                            <span>{{$settings["email"]}}</span>
                        </a>
                    @endif
                    @if($settings["footer_phone_on"])
                        <a href="tel:{{ $settings['phone'] }}" class="item">
                            <i class="fal fa-phone"></i>
                            <span>{{ $settings['phone'] }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="site_map">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div class="single_list">
                                <div class="head">خريطة الموقع</div>
                                <ul class="list">
                                    <li><a href="#">من نحن</a></li>
                                    <li><a href="#">المقالات</a></li>
                                    <li><a href="#">المتجر</a></li>
                                    <li><a href="#">المنتجات</a></li>
                                    <li><a href="#">حسابي</a></li>
                                    <li><a href="#">اتصل بنا</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="single_list">
                                <div class="head">روابط مختصرة</div>
                                <ul class="list">
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="single_list">
                                <div class="head">روابط هامة</div>
                                <ul class="list">
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                    <li><a href="#">روابط مختصرة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location">
                    <div class="head">الفرع الرئيسي</div>
                    <div class="map">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"></iframe>
                    </div>
                </div>
                <div class="apps">
                    <div class="head">@lang('lang.download_our_app')</div>
                    <div class="images">
                    @if ($settings["footer_app1_on"])
                    <a href="{{ $settings['footer_app_url1'] }}">
                        <img class="img-fluid" src="{{ url("{$settings['footer_app_image1']}") }}">
                    </a>
                    @endif
                    @if ($settings["footer_app2_on"])
                    <a href="{{ $settings['footer_app_url2'] }}">
                        <img class="img-fluid" src="{{ url("{$settings['footer_app_image2']}") }}">
                    </a>
                    @endif
                    </div>
                    <div class="sochial">
                    @if ($settings["social1_on"])
                            <a href="{{ $settings['social1_url'] }}">
                                <i class="{{ $settings['social1_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social2_on"])
                            <a href="{{ $settings['social2_url'] }}">
                                <i class="{{ $settings['social2_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social3_on"])
                            <a href="{{ $settings['social3_url'] }}">
                                <i class="{{ $settings['social3_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social4_on"])
                            <a href="{{ $settings['social4_url'] }}">
                                <i class="{{ $settings['social4_icon'] }}"></i>
                            </a>
                            @endif
                            @if ($settings["social5_on"])
                            <a href="{{ $settings['social5_url'] }}">
                                <i class="{{ $settings['social5_icon'] }}"></i>
                            </a>
                            @endif
                    </div>
                </div>
            </div>
            <!--======================= Start copyright Section ===========================-->
            <div class="copyright">
                <div class="row">
                    <div class="col-sm-6 copy">
                    <p><span>&copy;</span> <bdi>@lang('lang.all_rights_reserved')</bdi> <a href="{{ url('/') }}"
                            class="btn"> @lang('lang.title')</a></p>
                    </div>
                    <div class="col-sm-6 image">
                        <div class="ryad-logo" style="display: inline-block;">
                            <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#fff">
                                <svg height="90" width="102" style=" transform: rotateY(180deg) scale(.35);float: left;width: 77px;">
                                    <line x1="0" y1="0" x2="90" y2="0" style="stroke:#f00;stroke-width:35" />
                                    <line x1="100" y1="0" x2="0" y2="10" style="stroke:#f00;stroke-width:20; transform:rotate(40deg)" />
                                    <line x1="10" y1="95" x2="50" y2="45" style="stroke:#f00;stroke-width:20;" />
                                </svg>
                            </a>
                            <div class="lolo-co" style="float: right;text-align: left;padding-top: 30px;position: relative;left: -15px;">
                                <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#fff;text-decoration: none;">
                                    <p style="text-transform: uppercase;font-family: sans-serif;font-size: 24px;line-height: 0.7;margin: 0;font-weight: 700;">elryad</p>
                                </a>
                                <span style="font-size: 12px;font-family: sans-serif; color:#fff;">
                                    <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">تصميم مواقع </a> /
                                     <a target="_balnk" href="https://elryad.com/ar/برمجة-تطبيقات-الجوال/" title="تطبيقات" alt="تطبيقات" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">تطبيقات</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--======================= Start copyright Section ===========================-->
        </div>

    </footer>
    <!--==================== End Footer =======================-->












    <!-- vendor scripts -->
    <script src="{{url('/')}}/public/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="{{url('/')}}/public/assets/vendor/popper.js"></script>
    <script src="{{url('/')}}/public/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/public/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/public/assets/vendor/wow/wow.js"></script>

    <!-- main.js -->
    <script src="{{url('/')}}/public/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (\Session::has('alert'))
    <script>
        Swal.fire({
            icon: "{{ \Session::get('alert')['icon'] }}",
            title: "{{ \Session::get('alert')['title'] }}",
            text: "{{ \Session::get('alert')['text'] }}"
        });
    </script>
    @endif
        <!-- begin - scripts used only by this page -->
        @yield('additional_scripts')
    <!-- end - scripts used only by this page -->
</body>

</html>