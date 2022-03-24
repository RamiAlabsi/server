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

    <!-- SITE TITLE -->
    <title>@lang('lang.title')</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('/') }}/public/assets/images/favicon.png">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/animate.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/FontAwesome/all.min.css">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/themify-icons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/linearicons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/flaticon.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/simple-line-icons.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/magnific-popup.css">
    <!-- jquery-ui CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/jquery-ui.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/slick.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/slick-theme.css">

    @if(app()->getLocale() == 'en')
    <!-- ltr Style CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/responsive.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/index.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style_2.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style-ltr_2.css">
    @else
    <!-- rtl Style CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/responsive-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/index-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/rtl-style.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style_2.css">
    @endif

    <!-- begin - scripts used only by this page -->
    @yield('additional_css')
    <!-- end - scripts used only by this page -->
</head>

<body style="background-color: #F5F5F5;">
    <!-- LOADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- END LOADER -->
    <!-- Home Popup Section -->
    @if(isset($popup))
    @if ($popup == true)
    <div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                    </button>
                    <div class="row no-gutters">
                        <div class="col-sm-5">
                            <div class="background_bg h-100"
                                data-img-src="{{ URL::to('/') }}/public/assets/images/popup_img.jpg"></div>
                        </div>
                        <div class="col-sm-7">
                            <div class="popup_content">
                                <div class="popup-text">
                                    <div class="heading_s4">
                                        <h4>Subscribe and Get 25% Discount!</h4>
                                    </div>
                                    <p>Subscribe to the newsletter to receive updates about new products.</p>
                                </div>
                                <form method="post">
                                    <div class="form-group">
                                        <input name="email" required type="email" class="form-control rounded-0"
                                            placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-fill-line btn-block text-uppercase rounded-0"
                                            title="Subscribe" type="submit">Subscribe</button>
                                    </div>
                                </form>
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox3" value="">
                                        <label class="form-check-label" for="exampleCheckbox3"><span>Don't show this
                                                popup again!</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    <!-- End Screen Load Popup Section -->

    <!-- START HEADER -->
    <!--================================= Start nav-top ==============================-->
    <section class="nav-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="speach">
                        @if ($settings["header_features_on"])
                        <p class="line-after">@lang('lang.header_feature_1')</p>
                        <p>@lang('lang.header_feature_2')</p>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="setting-site">
                        @guest
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="login-btn line-after">@lang('lang.register')</a>
                        @endif
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="login-btn line-after">@lang('lang.login')</a>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown btn" class="nav-link dropdown-toggle navbarDropdownlogin" href="#"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <bdi> {{ Auth::user()->name }}</bdi>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    @lang('lang.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <a href="{{route('vendor')}}"
                            class="line-after main-color sell">@lang('lang.header_sell_statement')
                            @lang('lang.title')</a>
                        <div class="switch-lang">
                            <span>{{ app()->getLocale() }}<i class="fas fa-chevron-down"></i></span>
                            <div class="dropdown-list">
                                @foreach (\App\Models\Language::all() as $lang)
                                @if (strtolower($lang->locale) != strtolower(app()->getLocale()))
                                <a class="dropdown-item login-btn"
                                    href="{{ str_replace(strtolower('/' . app()->getLocale()), '/' . $lang->locale, Request::fullUrl()) }}">
                                    {{ $lang->locale }} </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================= End nav-top ==============================-->
    <!--================================= Start navbar ==============================-->
    <nav class="nav-menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ URL::to('/') }}/public/images/Group 88.png" alt="logo" class="img-fluid">
                    </a>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-8">
                    <div class="search-box">
                        <form action="{{ url(app()->getLocale() . '/products') }}" class="d-flex" id="search_form">
                            <select class="select-catig" name="category_id">
                                <option selected value="0">@lang('lang.all_categories')</option>
                                @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->translation->name }}</option>
                                @endforeach
                            </select>
                            <span class="line-after"></span>
                            <input type="search" placeholder="ابحث في المنتجات" class="form-control" name="search_text"
                                required>
                            <button class="icon-search" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="sochial">
                        <div class="media">
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
                        <div class="toggle-menu" id="navbartoggler">
                            <a href="#"><i class="fas fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--================================= End navbar ==============================-->

    <!--================================= Start side nav ==============================-->
    <div class="mobile-menu" id="mobile-list">
        <ul class="list-side">
            <li><a href="{{ url('/') }}">@lang('lang.home')</a></li>
            <li><a href="{{ url('/products') }}">@lang('lang.products')</a></li>
            <li class="drop-side">
                <a href="#">@lang('lang.profile')<i class="fas fa-chevron-down"></a></i>
                <ul>
                    <li><a href="{{ url('my_account') }}">@lang('lang.my_account')</a></li>
                    <li><a href="{{ url('wishlist') }}">@lang('lang.wishlist')</a></li>
                    <li><a href="{{ url('chat') }}">@lang('lang.chat')</a></li>
                </ul>
            </li>
        </ul>
        <div class="close"><i class="fas fa-times"></i></div>
        @if (Auth::user() != null)
        <a href="{{ url('/cart') }}" class="cart">
            <span class="products-n">{{ count(Auth::user()->cart_items) }}</span>
            <i class="fas fa-shopping-cart"></i>
        </a>
        @endif


    </div>
    <!--================================= End side nav ==============================-->
    <!-- END HEADER -->

    <!-- START SECTION BREADCRUMB -->
    @if(isset($breadcrumb))
    @if ($breadcrumb == true)
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6" style="text-align: start;">
                    <div class="page-title">
                        <h1>@lang('lang.' . Request::segment(2))</h1>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: end;">
                    <ol class="breadcrumb justify-content-md-end">
                        @for ($i = 2;; $i++)
                        @php
                        $segmentName = Request::segment($i);
                        $segmentLang = 'lang.' . $segmentName;
                        @endphp
                        @if (Request::segment($i + 1) == "")
                        <li class="breadcrumb-item active">@lang($segmentLang)</li>
                        @break
                        @endif
                        <li class="breadcrumb-item"><a href="{{ url($segmentName) }}">@lang($segmentLang)</a></li>
                        @endfor
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    @endif
    @endif
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->

    @yield('content');

    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    @if(isset($subscribe_newsletter))
    @if ($subscribe_newsletter == true)
    <section class="subscribe">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <span class="sale">10% -</span>
                </div>
                <div class="col-md-5">
                    <h2>اشترك في النشرة الإخبارية لدينا و
                        تلقي عروض حصرية كل أسبوع
                    </h2>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="ضع ايميلك هنا ">
                </div>
                <div class="col-md-2">
                    <a class="btn" href="#">اشترك</a>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endif
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <!-- END MAIN CONTENT -->

    <!-- START FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1>@lang('lang.about_us')</h1>
                    @if($settings["footer_small_description_on"])
                    <p>@lang('lang.about_us_small_description')</p>
                    @endif
                    @if($settings["footer_phone_on"])
                    <p><i class="fas fa-phone"></i> {{ $settings['phone'] }}</p>
                    @endif
                    @if($settings["footer_email_on"])
                    <p><i class="fas fa-envelope"></i> {{ $settings['email'] }}</p>
                    @endif
                    <p class="social">
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
                    </p>
                </div>
                <div class="col-md-3">
                    <h1>@lang('lang.personal_profile')</h1>
                    <a href="{{ url('my_account') }}" class="btn">@lang('lang.my_account')</a>
                    <a href="{{ url('wishlist') }}" class="btn">@lang('lang.wishlist')</a>
                    <a href="{{ url('chat') }}" class="btn">@lang('lang.chat')</a>
                </div>
                <div class="col-md-3">
                    <h1>@lang('lang.info')</h1>
                    <a href="{{ url('/about') }}" class="btn">@lang('lang.about_us')</a>
                    {{-- <a href="{{ url('/contact') }}" class="btn">@lang('lang.contact_us')</a> --}}
                    <a href="{{ url('/faq') }}" class="btn">@lang('lang.faq')</a>
                    <a href="{{ url('/term_condition') }}" class="btn">@lang('lang.terms_and_conditions')</a>
                </div>
                <div class="col-md-3 apps">
                    <h1>@lang('lang.download_our_app')</h1>
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
            </div>
            <div class="row copyright-row">
                <span class="hr"></span>
                <div class="col-md-6 copyright">
                    <p><span>&copy;</span> <bdi>@lang('lang.all_rights_reserved')</bdi> <a href="{{ url('/') }}"
                            class="btn"> @lang('lang.title')</a></p>
                </div>
                <div class="col-md-6 ryad-logo">
                    <img class="img-fluid" src="{{ URL::to('/') }}/public/images/Rectangle 424.png">
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

    <!-- begin - scripts used only by this page -->
    @yield('ajax_scripts')
    <!-- Latest jQuery -->
    <script src="{{ URL::to('/') }}/public/assets/js/jquery-1.12.4.min.js"></script>
    <!-- jquery-ui -->
    <script src="{{ URL::to('/') }}/public/assets/js/jquery-ui.js"></script>
    <!-- popper min js -->
    <script src="{{ URL::to('/') }}/public/assets/js/popper.min.js"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="{{ URL::to('/') }}/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- owl-carousel min js  -->
    <script src="{{ URL::to('/') }}/public/assets/owlcarousel/js/owl.carousel.min.js"></script>
    <!-- magnific-popup min js  -->
    <script src="{{ URL::to('/') }}/public/assets/js/magnific-popup.min.js"></script>
    <!-- waypoints min js  -->
    <script src="{{ URL::to('/') }}/public/assets/js/waypoints.min.js"></script>
    <!-- parallax js  -->
    <script src="{{ URL::to('/') }}/public/assets/js/parallax.js"></script>
    <!-- countdown js  -->
    <script src="{{ URL::to('/') }}/public/assets/js/jquery.countdown.min.js"></script>
    <!-- imagesloaded js -->
    <script src="{{ URL::to('/') }}/public/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js -->
    <script src="{{ URL::to('/') }}/public/assets/js/isotope.min.js"></script>
    <!-- jquery.dd.min js -->
    <script src="{{ URL::to('/') }}/public/assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="{{ URL::to('/') }}/public/assets/js/slick.min.js"></script>
    <!-- elevatezoom js -->
    <script src="{{ URL::to('/') }}/public/assets/js/jquery.elevatezoom.js"></script>
    <!-- scripts js -->
    <script src="{{ URL::to('/') }}/public/assets/js/scripts.js"></script>

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