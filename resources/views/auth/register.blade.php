@extends('layouts.auth_layout')

@section('content')
<div class="main_content">
    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>@lang('lang.create_account')</h3>
                            </div>
                            <form method="post" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus
                                        placeholder="@lang('lang.enter_your_name')">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" required=""
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="@lang('lang.enter_your_email')" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control @error('password') is-invalid @enderror" required=""
                                        type="password" name="password" placeholder="@lang('lang.password')" required
                                        autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required="" type="password" name="password_confirmation"
                                        placeholder="@lang('lang.confirm_password')" required
                                        autocomplete="new-password">
                                </div>
                                <div class="vendor-content"></div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="exampleCheckbox2" value="1" required onclick="if(this.value == 1)">
                                            <label class="form-check-label"
                                                for="exampleCheckbox2"><span>@lang('lang.i_agree_to')
                                                    <a href="{{ url('/term_condition') }}"
                                                        style="text-transform: lowercase;">@lang('lang.terms_and_conditions')</a></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="radio" name="register_as_vendor" value="0" checked> @lang('lang.register_as_user')
                                    <input type="radio" name="register_as_vendor" value="1"> @lang('lang.register_as_vendor')
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="register"
                                        id="register_btn" disabled>@lang('lang.register')</button>
                                </div>
                            </form>
                            <div class="different_login">
                                <span> @lang('lang.or')</span>
                            </div>
                            {{--    <ul class="btn-login list_none text-center">
                                <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a>
                                </li>
                                <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a>
                                </li>
                            </ul>--}}
                            <div class="form-note text-center">@lang('lang.already_have_account') <a
                                    href="{{route('login')}}">@lang('lang.login')</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    document.getElementById("exampleCheckbox2").onchange = function(){
        var register_btn = document.getElementById("register_btn");
        if(this.checked == true)
            register_btn.disabled = false;
        else
            register_btn.disabled = true;
    };

    $(document).ready(function(){
        $('.vendor-content').html(`<div class="form-group"><input class="form-control" required="" type="text" name="phone" placeholder="@lang('lang.phone')" required> @error('phone') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror</div>
            <div class="form-group"><input class="form-control" required="" type="text" name="country" placeholder="@lang('lang.country')" required> @error('country') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror</div>
            
            <div class="form-group"><input class="form-control" required="" type="text" name="city" placeholder="@lang('lang.city')" required>@error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="street" placeholder="@lang('lang.street')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="building_number" placeholder="@lang('lang.building_num')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="postal_code" placeholder="@lang('lang.postal_code')" required> </div>`);
    });
    
    $('input[name="register_as_vendor"]').on('change',function(){
        if($('input[name="register_as_vendor"]:checked').val() == 1 )
        {
            $('.vendor-content').html(`<div class="form-group"><input class="form-control" required="" type="text" name="corporate_name" placeholder="@lang('lang.corporate_name')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="number" name="tax_number" placeholder="@lang('lang.tax_number')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="number" name="iban" placeholder="@lang('lang.iban')" required> </div>`);
        }else{
            $('.vendor-content').html(`<div class="form-group"><input class="form-control" required="" type="text" name="phone" placeholder="@lang('lang.phone')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="country" placeholder="@lang('lang.country')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="city" placeholder="@lang('lang.city')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="street" placeholder="@lang('lang.street')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="building_number" placeholder="@lang('lang.building_num')" required> </div>
            <div class="form-group"><input class="form-control" required="" type="text" name="postal_code" placeholder="@lang('lang.postal_code')" required> </div>`);
        }
      
    })
</script>
@endsection