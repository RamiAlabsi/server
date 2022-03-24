@extends('layouts.website_layout')
@section('title')
<title>@lang('lang.login')</title>
@endsection
@section('content')
   <!--================================= start login page ==============================-->
   <section class="login_page">
        <div class="container">
            <div class="modal_form">
                <div class="row">
                    <div class="col-md-6 border_form o-2">
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="head">@lang('lang.login')</div>
                            <div class="form-group">
                                <input type="text" required=""
                                        class="form-control  @error('email') is-invalid @enderror" name="email"
                                        placeholder="@lang('lang.email')">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="form-group pass-group">
                                <input class="form-control  @error('password') is-invalid @enderror" required=""
                                        type="password" name="password" placeholder="@lang('lang.password')" id="password-field">
                                <span toggle="#password-field" class="fa toggle-password fa-eye"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="form-group custom">
                                <div>
                                    <input type="checkbox" id="agree">
                                    <label for="agree">@lang('lang.Agree with terms and conditions ?')</label>
                                </div>
                                <div>
                                    <a href="{{ route('password.request') }}" class="forget_pass">@lang('lang.are you forget password?')</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="login_btn"><i class="fas fa-envelope"></i>@lang('lang.login')</button>
                            </div>
                            <div class="form-group">
                                <a href="#" class="login_btn face"><i class="fab fa-facebook-f"></i> @lang('lang.loginWithFacebook')</a>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('register') }}" class="create">@lang('lang.signup_now')</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="image">
                            <img src="{{url('/')}}/public/assets/img/login.png" alt="img" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================= End login page ==============================-->

@endsection