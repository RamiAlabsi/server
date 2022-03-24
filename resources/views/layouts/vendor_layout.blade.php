<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{URL::TO('/')}}/public/admin_assets/images/favicon_1.ico">

    <title>@lang('lang.title') - @lang('lang.vendor_panel')</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{URL::TO('/')}}/public/admin_assets/plugins/morris/morris.css">

    <link href="{{URL::TO('/')}}/public/admin_assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::TO('/')}}/public/admin_assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::TO('/')}}/public/admin_assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::TO('/')}}/public/admin_assets/css/pages.css" rel="stylesheet" type="text/css" />

    <link href="{{URL::TO('/')}}/public/admin_assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::TO('/')}}/public/admin_assets/css/responsive.css" rel="stylesheet" type="text/css" />
    @if(app()->getLocale() == 'en')
    <link href="{{URL::TO('/')}}/public/admin_assets/css/core-ltr.css" rel="stylesheet" type="text/css" />
    <link href="{{URL::TO('/')}}/public/admin_assets/css/responsive-ltr.css" rel="stylesheet">
    @endif

    @yield('css')
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="{{URL::TO('/')}}/public/admin_assets/js/modernizr.min.js"></script>

</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{url('/')}}" class="logo"><i class="icon-magnet icon-c-logo"></i><span><i
                                class="md md-album"></i>@lang('lang.title')</span></a>
                    <!-- Image Logo here -->
                    <!--<a href="index.html" class="logo">-->
                    <!--<i class="icon-c-logo"> <img src="{{URL::TO('/')}}/public/admin_assets/images/logo_sm.png" height="42"/> </i>-->
                    <!--<span><img src="{{URL::TO('/')}}/public/admin_assets/images/logo_light.png" height="20"/></span>-->
                    <!--</a>-->
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="md md-menu"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li>
                                @foreach (\App\Models\Language::all() as $lang)
                                @if (strtolower($lang->locale) != strtolower(app()->getLocale()))
                                <a class="lang"
                                    href="{{ str_replace(strtolower('/' . app()->getLocale()), '/' . $lang->locale, Request::fullUrl()) }}">
                                    {{ $lang->locale }} </a>
                                @endif
                                @endforeach
                            </li>
                            <!--<li class="dropdown top-menu-item-xs">-->
                            <!--    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"-->
                            <!--        data-toggle="dropdown" aria-expanded="true">-->
                            <!--        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>-->
                            <!--    </a>-->

                                <!--<ul class="dropdown-menu dropdown-menu-lg">-->
                                <!--    <li class="notifi-title"><span-->
                                <!--            class="label label-default pull-right">@lang('lang.new')-->
                                <!--            3</span>@lang('lang.notification')</li>-->
                                <!--    <li class="list-group slimscroll-noti notification-list">-->
                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-diamond noti-primary"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">A new order has been placed A new order-->
                                <!--                        has been placed</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>There are new settings available</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->

                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-cog noti-warning"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">New settings</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>There are new settings available</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->

                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-bell-o noti-custom"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">Updates</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>There are <span class="text-primary font-600">2</span>-->
                                <!--                            new updates available</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->

                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-user-plus noti-pink"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">New user registered</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>You have 10 unread messages</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->

                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-diamond noti-primary"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">A new order has been placed A new order-->
                                <!--                        has been placed</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>There are new settings available</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->

                                        <!-- list item-->
                                <!--        <a href="javascript:void(0);" class="list-group-item">-->
                                <!--            <div class="media">-->
                                <!--                <div class="pull-left p-r-10">-->
                                <!--                    <em class="fa fa-cog noti-warning"></em>-->
                                <!--                </div>-->
                                <!--                <div class="media-body">-->
                                <!--                    <h5 class="media-heading">New settings</h5>-->
                                <!--                    <p class="m-0">-->
                                <!--                        <small>There are new settings available</small>-->
                                <!--                    </p>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </a>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <a href="javascript:void(0);" class="list-group-item text-right">-->
                                <!--            <small class="font-600">@lang('lang.all_notifications')</small>-->
                                <!--        </a>-->
                                <!--    </li>-->
                                <!--</ul>-->
                            <!--</li>-->
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                        class="icon-size-fullscreen"></i></a>
                            </li>
                            <!--<li class="hidden-xs">-->
                            <!--    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>-->
                            <!--</li>-->
                            <li class="dropdown top-menu-item-xs">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light"
                                    data-toggle="dropdown" aria-expanded="true"><img
                                        src="{{URL::TO('/')}}/public/admin_assets/images/users/avatar-1.jpg"
                                        alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    {{-- <li><a href="{{route('profile')}}"><i class="ti-user m-r-10 text-custom"></i>
                                    {{__('admin.profile')}}</a>
                            </li>
                            <li><a href="javascript:void(0)"><i
                                        class="ti-settings m-r-10 text-custom"></i>{{__('admin.settings')}}</a></li>
                            <li><a href="javascript:void(0)"><i
                                        class="ti-lock m-r-10 text-custom"></i>{{__('admin.lock screen')}}</a></li> --}}
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <i class="ti-power-off m-r-10 text-danger"></i>
                                    @lang('lang.logout')

                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <!-- <li class="text-muted menu-title">Navigation</li> -->
                        <li>
                            <a href="{{ route('vendor') }}" class="waves-effect">
                                <i class="ti-home"></i>
                                <span> @lang('lang.vendor_panel') </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/vendor/stores') }}" class="waves-effect">
                                <i class="ti-home"></i>
                                <span> @lang('lang.stores') </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/vendor/products') }}" class="waves-effect">
                                <i class="ti-home"></i>
                                <span> @lang('lang.products') </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/vendor/orders') }}" class="waves-effect">
                                <i class="ti-home"></i>
                                <span>@lang('lang.orders')</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/vendor/user_offers') }}" class="waves-effect">
                                <i class="ti-home"></i>
                                <span> @lang('lang.user_offers') </span>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Content -->
        <div class="content-page">
            @yield('content')
            <footer class="footer text-right">
                © 2021. All rights reserved.
            </footer>
        </div>
        <!-- End Content -->
        <!-- Right Sidebar -->
        {{--
        <div class="side-bar right-bar nicescroll">
            <h4 class="text-center">{{__('admin.chat')}}</h4>
        <div class="contact-list nicescroll">
            <ul class="list-group contacts-list">
                <li class="list-group-item">
                    <a href="#">
                        <div class="avatar">
                            <img src="{{URL::TO('/')}}/public/admin_assets/images/users/avatar-1.jpg" alt="">
                        </div>
                        <span class="name">Chadengle</span>
                        <i class="fa fa-circle online"></i>
                    </a>
                    <span class="clearfix"></span>
                </li>
            </ul>
        </div>
    </div>
    --}}
    <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->



    <script>
        var resizefunc = [];

    </script>

    <!-- jQuery  -->
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.min.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/bootstrap-rtl.min.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/detect.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/fastclick.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.slimscroll.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.blockUI.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/waves.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/wow.min.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.nicescroll.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.scrollTo.min.js"></script>

    <!-- Counterup  -->
    <script src="{{URL::TO('/')}}/public/admin_assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/plugins/counterup/jquery.counterup.min.js"></script>

    {{-- <script src="{{URL::TO('/')}}/public/admin_assets/plugins/morris/morris.min.js"></script> --}}
    <script src="{{URL::TO('/')}}/public/admin_assets/plugins/raphael/raphael-min.js"></script>

    {{-- <script src="{{URL::TO('/')}}/public/admin_assets/pages/jquery.dashboard_4.js"></script> --}}

    @yield('script')

    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.core.js"></script>
    <script src="{{URL::TO('/')}}/public/admin_assets/js/jquery.app.js"></script>
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

</body>

</html>