@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center order_complete">
                        <i class="fas fa-check-circle"></i>
                        <div class="heading_s1">
                            <h3>@lang('lang.order_completed')</h3>
                        </div>
                        <p>@lang('lang.order_completed_msg')</p>
                        <a href="{{ url('/') }}" class="btn btn-fill-out">@lang('lang.continue_shopping')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
</div>
@endsection
