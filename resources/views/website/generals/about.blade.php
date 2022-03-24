@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- START SECTION ABOUT -->
    @if ($settings["about_who_we_are_section_on"])
    <div class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about_img scene mb-4 mb-lg-0">
                        <img src="{{ url($settings['about_who_we_are_image']) }}" alt="about_img" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading_s1">
                        <h2>@lang('lang.about_who_we_are_title')</h2>
                    </div>
                    @lang('lang.about_who_we_are_content')
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END SECTION ABOUT -->

    <!-- START SECTION WHY CHOOSE -->
    @if ($settings["about_choose_us_section_on"])
    <div class="section bg_light_blue2 pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="heading_s1 text-center">
                        <h2>@lang('lang.about_choose_us_title')</h2>
                    </div>
                    <p class="text-center leads">@lang('lang.about_choose_us_description')</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon_box icon_box_style4 box_shadow1">
                        <div class="icon">
                            <i class="{{ $settings['about_choose_us_icon1'] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_choose_us_section1_title')</h5>
                            <p>@lang('lang.about_choose_us_section1_text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="icon_box icon_box_style4 box_shadow1">
                        <div class="icon">
                            <i class="{{ $settings['about_choose_us_icon2'] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_choose_us_section2_title')</h5>
                            <p>@lang('lang.about_choose_us_section2_text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="icon_box icon_box_style4 box_shadow1">
                        <div class="icon">
                            <i class="{{ $settings['about_choose_us_icon3'] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_choose_us_section3_title')</h5>
                            <p>@lang('lang.about_choose_us_section3_text')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END SECTION WHY CHOOSE -->

    <!-- START SECTION TEAM -->
    {{-- <div class="section pb_70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="heading_s1 text-center">
                        <h2>@lang('lang.about_members_title')</h2>
                    </div>
                    <p class="text-center leads">@lang('lang.about_members_description')</p>
                </div>
            </div>
            @if ($settings["about_members_section_on"])
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ url("{$settings['about_members_image1']}") }}" alt="team_img1">
                            <ul class="social_icons social_style1">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>{{ $settings["about_member1_name"] }}</h5>
                                <span>@lang('lang.about_member1_role')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ url("{$settings['about_members_image2']}") }}" alt="team_img2">
                            <ul class="social_icons social_style4">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>{{ $settings["about_member2_name"] }}</h5>
                                <span>@lang('lang.about_member2_role')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ url("{$settings['about_members_image3']}") }}" alt="team_img3">
                            <ul class="social_icons social_style4">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>{{ $settings["about_member3_name"] }}</h5>
                                <span>@lang('lang.about_member3_role')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="team_box team_style1">
                        <div class="team_img">
                            <img src="{{ url("{$settings['about_members_image4']}") }}" alt="team_img4">
                            <ul class="social_icons social_style4">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                        <div class="team_content">
                            <div class="team_title">
                                <h5>{{ $settings["about_member4_name"] }}</h5>
                                <span>@lang('lang.about_member4_role')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div> --}}
    <!-- END SECTION TEAM -->

    <!-- START SECTION TESTIMONIAL -->
    {{-- <div class="section bg_redon">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>Our Client Say!</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9" style="direction: ltr;">
                    <div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2"
                        data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true"
                        data-items='1'>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi
                                    blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi
                                    nam natus perferendis possimus quasi sint sit tempora voluptatem.</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{ URL::to('/') }}/public/assets/images/user_img1.jpg" alt="user_img1" />
                                </div>
                                <div class="author_name">
                                    <h6>Lissa Castro</h6>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi
                                    blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi
                                    nam natus perferendis possimus quasi sint sit tempora voluptatem.</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{ URL::to('/') }}/public/assets/images/user_img2.jpg" alt="user_img2" />
                                </div>
                                <div class="author_name">
                                    <h6>Alden Smith</h6>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi
                                    blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi
                                    nam natus perferendis possimus quasi sint sit tempora voluptatem.</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{ URL::to('/') }}/public/assets/images/user_img3.jpg" alt="user_img3" />
                                </div>
                                <div class="author_name">
                                    <h6>Daisy Lana</h6>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_box">
                            <div class="testimonial_desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquam amet animi
                                    blanditiis consequatur debitis dicta distinctio, enim error eum iste libero modi
                                    nam natus perferendis possimus quasi sint sit tempora voluptatem.</p>
                            </div>
                            <div class="author_wrap">
                                <div class="author_img">
                                    <img src="{{ URL::to('/') }}/public/assets/images/user_img4.jpg" alt="user_img4" />
                                </div>
                                <div class="author_name">
                                    <h6>John Becker</h6>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END SECTION TESTIMONIAL -->

    <!-- START SECTION SHOP INFO -->
    @if ($settings["about_features_section_on"])
    <div class="section pb_70">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="{{ $settings["about_feature1_icon"] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_feature1_title')</h5>
                            <p>@lang('lang.about_feature1_text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="{{ $settings["about_feature2_icon"] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_feature1_title')</h5>
                            <p>@lang('lang.about_feature2_text')</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon_box icon_box_style1">
                        <div class="icon">
                            <i class="{{ $settings["about_feature3_icon"] }}"></i>
                        </div>
                        <div class="icon_box_content">
                            <h5>@lang('lang.about_feature1_title')</h5>
                            <p>@lang('lang.about_feature3_text')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END SECTION SHOP INFO -->
</div>
@endsection