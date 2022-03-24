@extends('layouts.website_layout')

@section('additional_css')
<!--============== Custom style in CheckOut Page only ==============-->
<link rel="stylesheet" href="{{ URL::TO('/') }}/public/assets/css/style-checkout.css">
<link rel="stylesheet" href="{{ URL::TO('/') }}/public/assets/css/responsive-checkout.css">
@endsection

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="toggle_info">
                        <span><i class="fas fa-user"></i>Returning customer? <a href="#loginform" data-toggle="collapse"
                                class="collapsed" aria-expanded="false">Click here to login</a></span>
                    </div>
                    <div class="panel-collapse collapse login_form" id="loginform">
                        <div class="panel-body">
                            <p>If you have shopped with us before, please enter your details below. If you are a new
                                customer, please proceed to the Billing &amp; Shipping section.</p>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="email"
                                        placeholder="Username Or Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required="" type="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="remember" value="">
                                            <label class="form-check-label" for="remember"><span>Remember
                                                    me</span></label>
                                        </div>
                                    </div>
                                    <a href="#">Forgot password?</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="login">Log
                                        in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="toggle_info">
                        <span><i class="fas fa-tag"></i>Have a coupon? <a href="#coupon" data-toggle="collapse"
                                class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form" id="coupon">
                        <div class="panel-body">
                            <p>If you have a coupon code, please apply it below.</p>
                            <div class="coupon field_form input-group">
                                <input type="text" value="" class="form-control" placeholder="Enter Coupon Code..">
                                <div class="input-group-append">
                                    <button class="btn btn-fill-out btn-sm" type="submit">Apply Coupon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div> --}}
            <form method="post" action="{{ url(app()->getLocale() . '/checkout') }}" id="place_order_form">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1">
                        <h4>@lang('lang.billing_details')</h4>
                    </div>
                        @csrf
                        <div class="form-group">
                            <input type="text" required class="form-control" name="first_name" placeholder="@lang('lang.first_name') *" maxlength="255">
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" name="last_name" placeholder="@lang('lang.last_name') *" maxlength="255">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" name="company_name" placeholder="@lang('lang.company_name')" maxlength="255">
                        </div>
                        <div class="form-group">
                            <div class="custom_select">
                                <select class="form-control" required id="country_select">
                                    <option value="" disabled selected>@lang('lang.choose_country')</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->code }}">{{ $country->translation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom_select">
                                <select class="form-control" required id="state_select">
                                    <option value="" disabled selected>@lang('lang.choose_country')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom_select">
                                <select class="form-control" required name="city_id" id="city_select">
                                    <option value="" disabled selected>@lang('lang.choose_state')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" required=""
                                placeholder="@lang('lang.address') *" maxlength="255">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" name="postcode"
                                placeholder="@lang('lang.postcode') *" maxlength="255">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" name="phone" placeholder="@lang('lang.phone') *" maxlength="255">
                        </div>
                        <div class="form-group">
                            <input class="form-control" required type="text" name="email" placeholder="@lang('lang.email') *" maxlength="255">
                        </div>
                        {{-- <div class="form-group">
                            <div class="chek-form">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" for="createaccount"><span>Create an
                                            account?</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group create-account">
                            <input class="form-control" required type="password" placeholder="Password" name="password">
                        </div>
                        <div class="ship_detail">
                            <div class="form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="differentaddress">
                                        <label class="form-check-label label_info" for="differentaddress"><span>Ship to
                                                a different address?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="different_address">
                                <div class="form-group">
                                    <input type="text" required class="form-control" name="fname"
                                        placeholder="First name *">
                                </div>
                                <div class="form-group">
                                    <input type="text" required class="form-control" name="lname"
                                        placeholder="Last name *">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required type="text" name="cname"
                                        placeholder="Company Name">
                                </div>
                                <div class="form-group">
                                    <div class="custom_select">
                                        <select class="form-control" required>
                                            <option value="" disabled selected>@lang('lang.choose_country')</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->code }}">{{ $country->translation->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="billing_address" required=""
                                        placeholder="Address *">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="billing_address2" required=""
                                        placeholder="Address line2">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required type="text" name="city"
                                        placeholder="City / Town *">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required type="text" name="state"
                                        placeholder="State / County *">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required type="text" name="zipcode"
                                        placeholder="Postcode / ZIP *">
                                </div>
                            </div>
                        </div> --}}
                        <div class="heading_s1">
                            <h4>@lang('lang.additional_info')</h4>
                        </div>
                        <div class="form-group mb-0">
                            <textarea rows="5" class="form-control" name="notes" placeholder="@lang('lang.notes')"></textarea>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="heading_s1">
                            <h4>@lang('lang.your_orders')</h4>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('lang.product')</th>
                                        <th>@lang('lang.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php ($total_price = 0)
                                    @foreach ($cart_items as $cart_item)
                                    @php ($price = $cart_item->product->final_price * $cart_item->quantity)
                                    @php ($total_price += $price)
                                    <tr>
                                        <td>{{ $cart_item->product->translation->name }} <span class="product-qty">x {{ $cart_item->quantity }}</span></td>
                                        <td>{{ $price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>@lang('lang.subtotal')</th>
                                        <td class="product-subtotal">{{ $total_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('lang.shipping')</td>
                                        <td>@lang('lang.free_shipping')</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('lang.total')</th>
                                        <td class="product-subtotal">{{ $total_price }}</td>
                                        <input type="hidden" name="total_price" value="{{ $total_price }}">
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <div class="heading_s1">
                                <h4>@lang('lang.payment')</h4>
                            </div>
                            <div class="payment_option">
                                <div class="form-group">
                                    <input required="" type="radio" name="payment_option" id="exampleRadios1"
                                        value="0" checked="" maxlength="255">
                                    <label class="form-check-label" for="exampleRadios1">@lang('lang.visa')</label>
                                </div>
                                <div class="form-group">
                                    <input required="" type="radio" name="payment_option" id="exampleRadios2"
                                        value="1" checked="" maxlength="255">
                                    <label class="form-check-label" for="exampleRadios2">@lang('lang.cash_on_delivery')</label>
                                </div>
                                {{-- <div class="form-group">
                                    <input required="" type="radio" name="payment_option" id="exampleRadios3"
                                        value="option3" checked="">
                                    <label class="form-check-label" for="exampleRadios3"></label>
                                </div> --}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block">@lang('lang.place_order')</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
@endsection

@section('additional_scripts')
@if($errors->any())
    @foreach ($errors->all() as $error)
        <script>alert("{{ $error }}")</script>
    @endforeach
@endif
{{-- constructing an array for holding the states --}}
<script>var country_state_options = [];</script>
@foreach ($countries as $country)
    <script>country_state_options["{{ $country->code }}"] = "<option value='' disabled selected>@lang('lang.choose_state')</option>";</script>
    @foreach ($country->states as $state)
        <script>country_state_options["{{ $country->code }}"] += "<option value='{{ $state->code }}'>{{ $state->translation->name }}</option>"</script>
    @endforeach
@endforeach
<script>var state_city_options = [];</script>
@foreach ($states as $state)
    <script>state_city_options["{{ $state->code }}"] = "<option value='' disabled selected>@lang('lang.choose_city')</option>";</script>
    @foreach ($state->cities as $city)
        <script>state_city_options["{{ $state->code }}"] += "<option value='{{ $city->id }}'>{{ $city->translation->name }}</option>"</script>
    @endforeach
@endforeach
<script>
    $('#country_select').on('change', function(){
        $('#state_select').html(country_state_options[$(this).val()]);
    });
    $('#state_select').on('change', function(){
        $('#city_select').html(state_city_options[$(this).val()]);
    });
</script>
@endsection