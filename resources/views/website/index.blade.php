@extends('layouts.website_layout')
@section('title')
<title>@lang('lang.title')</title>
@endsection
@section('content')




    <!--==================== start banner_section =======================-->

    <section class="banner_section">
        <div class="container">
            <div class="row">
                <div class=" {{$settings['index_side_category_on'] == 1?'col-lg-7 offset-lg-3':'col-lg-8'}}">
                    <div class="owl-carousel owl-theme">
                        <div class="item_bg" style="background-image: url({{url('/')}}/public/assets/img/hero/banner_01.jpg);">
                            <div class="banner_slide_content">
                                <div class="col-lg-8 col-10">
                                    <div class="banner_content overflow-hidden">
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInRight" data-animation-delay="0.5s" style="animation-delay: 0.5s; opacity: 1;">خصم في جميع المنتجات 50٪</h5>
                                        <h2 class="staggered-animation" data-animation="slideInRight" data-animation-delay="1s" style="animation-delay: 1s; opacity: 1;">ملابس رجالي</h2>
                                        <a class="main-btn animated" href="shop-left-sidebar.html" data-animation="slideInRight" data-animation-delay="1.5s" style="animation-delay: 1.5s; opacity: 1;">تسوق الان</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item_bg" style="background-image: url({{url('/')}}/public/assets/img/hero/banner_02.png);">
                            <div class="banner_slide_content">
                                <div class="col-lg-8 col-10">
                                    <div class="banner_content overflow-hidden">
                                        <h5 class="mb-3 staggered-animation font-weight-light" data-animation="slideInRight" data-animation-delay="0.5s" style="animation-delay: 0.5s; opacity: 1;">خصم في جميع المنتجات 50٪</h5>
                                        <h2 class="staggered-animation" data-animation="slideInRight" data-animation-delay="1s" style="animation-delay: 1s; opacity: 1;">Man Fashion</h2>
                                        <a class="main-btn animated" href="shop-left-sidebar.html" data-animation="slideInRight" data-animation-delay="1.5s" style="animation-delay: 1.5s; opacity: 1;">تسوق الان</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="features">
                        <div class="box">
                            <div>
                                <i class="fad fa-credit-card"></i>
                                <span> دفع آمن 100%</span>
                            </div>
                        </div>
                        <div class="box">
                            <div>
                                <i class="fal fa-clock"></i>
                                <span>24  ساعة دعم</span>
                            </div>
                        </div>
                        <div class="box">
                            <div>
                                <i class="fal fa-money-bill-wave"></i>
                                <span>أفضل سعر</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" {{$settings['index_side_category_on'] == 1?'col-lg-2':'col-lg-4'}} banner_discount">
                    <div class="box col-lg-12 col-sm-6">
                        <div class="item">
                            <div class="info">
                                <h5 class="title">اكسسوارات</h5>
                                <h3 class="dis">خصم 50%</h3>
                            </div>
                        </div>

                    </div>
                    <div class="box col-lg-12 col-sm-6">
                        <div class="item">
                            <div class="info">
                                <h5 class="title">اكسسوارات</h5>
                                <h3 class="dis">خصم 50%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==================== End banner_section =======================-->

    <!--==================== start electronics_products =======================-->
    <section class="elec_products">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="side_banner">
                        <div class="image">
                            <img src="{{url('/')}}/public/assets/img/01.png" alt="img">
                            <div class="info">
                                <p>كاميرا 32 ميجا بيكسل</p>
                                <span>خصم 50%</span>
                                <a href="#" class="main-btn main">تسوق الان</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="main-heading">
                        <h4>الكترونيات</h4>
                    </div>
                    <div class="products-content">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <a href="#" class="box">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/elec/01.png" alt="img"></div>
                                    <div class="title">
                                        <h5>سماعات</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="#" class="box">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/elec/02.png" alt="img"></div>
                                    <div class="title">
                                        <h5>سماعات</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="#" class="box">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/elec/03.png" alt="img"></div>
                                    <div class="title">
                                        <h5>سماعات</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="#" class="box">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/elec/04.png" alt="img"></div>
                                    <div class="title">
                                        <h5>سماعات</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End electronics_products =======================-->

    <!--==================== start fixed prices =======================-->
    <section class="fixed_prices">
        <div class="container">
            <div class="main-heading">
                <h4>اسعار ثابته</h4>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <a href="#" class="box" style="background-image: url({{url('/')}}/public/assets/img/bg_2.png);">
                        <div class="info">
                            <h3>اي منتج هنا</h3>
                            <p><span>5.75</span>ريال</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="#" class="box" style="background-image: url({{url('/')}}/public/assets/img/bg_1.png);">
                        <div class="info">
                            <h3>اي منتج هنا</h3>
                            <p><span>5.75</span>ريال</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End fixed prices =======================-->

    <!--==================== start our_picks =======================-->
    <section class="our_picks">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="side_banner">
                        <div class="image">
                            <img src="{{url('/')}}/public/assets/img/02.png" alt="img">
                            <div class="info">
                                <p>كاميرا 32 ميجا بيكسل</p>
                                <span>خصم 50%</span>
                                <a href="#" class="main-btn main">تسوق الان</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="main-heading">
                        <h4>اخترنالك</h4>
                    </div>
                    <div class="products-content">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/01.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <span class="state">جديد</span>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/02.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <span class="state">جديد</span>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/03.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <span class="state">جديد</span>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/04.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <span class="state">جديد</span>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/05.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <span class="state">جديد</span>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End our_picks =======================-->

    <!--==================== Start discount banners =======================-->
    <section class="discount_banners">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="box">
                        <img src="{{url('/')}}/public/assets/img/png/1.png" alt="">
                        <div class="info">
                            <p>خصم <span>40%</span> علي هذا المنتج</p>
                            <h5>سماعة الرأس</h5>
                            <span class="big">للموسيقي</span>
                            <a href="#" class="main-btn animated">تسوق الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="box">
                        <img src="{{url('/')}}/public/assets/img/png/3.png" alt="">
                        <div class="info">
                            <p>خصم <span>40%</span> علي هذا المنتج</p>
                            <h5>ساعات يد عقارب</h5>
                            <span class="big">لمعرفة وقتك</span>
                            <a href="#" class="main-btn animated">تسوق الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 last">
                    <div class="box">
                        <img src="{{url('/')}}/public/assets/img/png/1.png" alt="">
                        <div class="info">
                            <p>خصم <span>40%</span> علي هذا المنتج</p>
                            <h5>كاميرات مراقبة</h5>
                            <span class="big">لأمان أكتر</span>
                            <a href="#" class="main-btn animated">تسوق الان</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End discount banners =======================-->

    <!--==================== start most_sell =======================-->
    <section class="our_picks most_sell">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="modern_products">
                        <div class="main-heading">
                            <h4>احدث المنتجات</h4>
                        </div>
                        <div class="box">
                            <img src="{{url('/')}}/public/assets/img/products/01.png" alt="img">
                            <div class="info">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <span class="price">770,00 ريال</span>
                            </div>
                        </div>
                        <div class="box">
                            <img src="{{url('/')}}/public/assets/img/products/02.png" alt="img">
                            <div class="info">
                                <h6>عنوان المنتج يعرض هنا</h6>
                                <span class="price">770,00 ريال</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="main-heading">
                        <h4>الاكثر مبيعا</h4>
                    </div>
                    <div class="products-content">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/05.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/06.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/07.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/01.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box-product">
                                    <div class="image"><img src="{{url('/')}}/public/assets/img/products/02.png" alt="img"></div>
                                    <div class="info">
                                        <p>وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه</p>
                                        <h6 class="seller">البائع : شركة الرياض للجوالات</h6>
                                        <div class="details">
                                            <span>770,00 ريال</span>
                                            <span>عدد القطع 12</span>
                                        </div>
                                    </div>
                                    <div class="icons">
                                        <a href="#"><i class="fal fa-heart"></i></a>
                                        <a href="#"><i class="fal fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End most_sell =======================-->

    <!--==================== Start Discount Section =======================-->
    <section class="discount_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/discount/01.png" alt="img">
                        <div class="info">
                            <h6>اكسسورات</h6>
                            <span>خصم 10%</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/discount/02.png" alt="img">
                        <div class="info">
                            <h6>اكسسورات</h6>
                            <span>خصم 10%</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/discount/03.png" alt="img">
                        <div class="info">
                            <h6>اكسسورات</h6>
                            <span>خصم 10%</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/discount/04.png" alt="img">
                        <div class="info">
                            <h6>اكسسورات</h6>
                            <span>خصم 10%</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End Discount Section =======================-->

    <!--==================== Start categories Section =======================-->
    <section class="categories_section">
        <div class="container">
            <div class="main-heading">
                <h4>تصفح عبر الأقسام</h4>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/catigories/01.png" alt="img">
                        <h5 class="title">عنوان القسم يعرض هنا</h5>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/catigories/02.png" alt="img">
                        <h5 class="title">عنوان القسم يعرض هنا</h5>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/catigories/03.png" alt="img">
                        <h5 class="title">عنوان القسم يعرض هنا</h5>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#" class="box">
                        <img src="{{url('/')}}/public/assets/img/catigories/04.png" alt="img">
                        <h5 class="title">عنوان القسم يعرض هنا</h5>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End categories Section =======================-->



@endsection