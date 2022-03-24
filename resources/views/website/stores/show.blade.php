@extends('layouts.website_layout')

@section('content')
<!--================================= Start All Stores ==============================-->
<section class="products-page all-stores">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="side-card">
                    <div class="head-card">
                        <img src="{{ URL::TO('/') }}/public/assets/images/Group 485.png" alt="store">
                        <h4>اسم المتجر</h4>
                    </div>
                    <div class="body-card">
                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على
                            الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك </p>
                    </div>
                    <div class="contact-card">
                        <h5>بيانات التواصل</h5>
                        <span class="item"><a href="tel:5554280940"><i class="fas fa-phone-alt"></i>+ 966 4575676
                                678</a></span>
                        <span class="item"><a href="mailto:youremailaddress"><i
                                    class="fa fa-envelope"></i>info@domainame.com</a></span>
                    </div>
                    <div class="footer-card">
                        <a href="#" class="btn"><i class="far fa-envelope"></i><span>مراسلة المتجر</span> </a>
                        <a href="#" class="btn"><i class="fas fa-phone-volume"></i><span>اتصل بنا</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="head">
                    <h5><i class="fas fa-store-alt"></i>@lang('lang.store_products')</h5>
                </div>
                <div class="content">
                    <div class="our-stores our-products">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="box">
                                    <div class="image">
                                        <img src="{{ URL::TO('/') }}/public/assets/images/product.png" alt="img">
                                        <a href="#" class="btn btn-store">زيارة المتجر</a>
                                    </div>
                                    <span>عنوان المنتج يعرض هنا</span>
                                    <span class="price">250 ريال</span>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================= End All Stores ==============================-->
@endsection