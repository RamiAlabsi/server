<?php
use App\Models\Language;
use \Illuminate\Support\Facades\Request;
?>

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

    <!-- begin - scripts used only by this page -->
    @yield('additional_css')
    <!-- end - scripts used only by this page -->

    @if(app()->getLocale() == 'en')
    <!-- ltr Style CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/responsive.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/index.css">
    @else
    <!-- rtl Style CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/style-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/responsive-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/index-rtl.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/rtl-style.css">
    @endif



</head>

<body>
    <!-- LOADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- End Screen Load Popup Section -->

    <!-- START HEADER -->
    <header class="header_wrap fixed-top header_with_topbar">
        <main class="main">
            <nav class="navbar navbar-expand-lg">
                
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <a href="{{ url('/') }}" class="logo"><img src="https://reda.azq1.com/abgadhwz/public/images/Group 88.png"/></a>
                    <ul class="navbar-nav mr-auto">
                        <!--<li class="nav-item">-->
                        <!--    <div class="dropdown">-->
                        <!--        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"-->
                        <!--            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--            {{ app()->getLocale() }} <i class="fas fa-angle-down"></i>-->
                        <!--        </a>-->
                        <!--        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">-->
                        <!--            @foreach (Language::all() as $lang)-->
                        <!--            @if (strtolower($lang->locale) != strtolower(app()->getLocale()))-->
                        <!--            <a class="dropdown-item"-->
                        <!--                href="{{ str_replace(strtolower(app()->getLocale()), $lang->locale, Request::fullUrl()) }}">-->
                        <!--                {{ $lang->locale }} </a>-->
                        <!--            @endif-->
                        <!--            @endforeach-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</li>-->
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
                    </ul>
                </div>
            </nav>
        </main>
    </header>
    <!-- END HEADER -->

    <!-- START MAIN CONTENT -->

    @yield('content');

    <!-- END MAIN CONTENT -->

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
</body>

</html>