@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard_menu">
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="dashboard-tab" data-toggle="tab"
                                    href="{{ route('vendor') }}" role="tab" aria-controls="dashboard"
                                    aria-selected="false"><i class="ti-layout-grid2"></i>@lang('lang.dashboard')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                                    aria-controls="orders" aria-selected="false"><i
                                        class="ti-shopping-cart-full"></i>@lang('lang.orders')</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                    aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i> @lang('lang.my_address')</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail"
                                    role="tab" aria-controls="account-detail" aria-selected="true"><i
                                        class="ti-id-badge"></i>@lang('lang.account_details')</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"><i
                                class="ti-lock"></i>@lang('lang.logout')</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="card" style="text-align: start;">
                                <div class="card-header">
                                    <a href="">
                                        <h3>@lang('lang.dashboard')</h3>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p>If you want to go to vendor dashboard <a href="{{ route('vendor') }}">Click
                                            Here</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>@lang('lang.orders')</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('lang.order')</th>
                                                    <th>@lang('lang.date')</th>
                                                    <th>@lang('lang.status')</th>
                                                    <th>@lang('lang.total')</th>
                                                    <th>@lang('lang.actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(Auth::user()->orders as $order)
                                                <tr>
                                                    <td>{{$order->id}}</td>
                                                    <td>{{$order->created_at}}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{$order->total}}</td>
                                                    <td><a href="{{ url('orders/' . $order->id) }}"
                                                            class="btn btn-fill-out btn-sm">@lang('lang.view')</a></td>
                                                </tr>
                                                @endforeach
                                                {{-- <tr>
                                                    <td>#2366</td>
                                                    <td>June 20, 2020</td>
                                                    <td>Completed</td>
                                                    <td>$81.00 for 1 item</td>
                                                    <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Shipping Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <address>{{ $auth()->user()->address }}</address>
                        <p>New York</p>
                        <a href="#" class="btn btn-fill-out">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
        <div class="card">
            <div class="card-header">
                <h3>@lang('lang.account_details')</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url(app()->getLocale() . "/users/" . Auth::user()->id) }}" name="enq">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>@lang('lang.name')<span class="required">*</span></label>
                            <input class="form-control" name="new_name" value="{{ auth()->user()->name }}" type="text">
                            @error('new_name')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('lang.email')<span class="required">*</span></label>
                            <input required="" class="form-control" name="new_email" value="{{ auth()->user()->email }}"
                                type="email">
                            @error('new_email')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('lang.current_password') <span class="required">*</span></label>
                            <input required="" class="form-control" name="current_pass" type="password">
                            @error('current_pass')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('lang.new_password') <span class="required"></span></label>
                            <input class="form-control" name="new_pass" type="password" id="new_pass">
                        </div>
                        @error('new_pass')
                        {{ $message }}
                        @enderror
                        <div class="form-group col-md-12">
                            <label>@lang('lang.confirm_password') <span class="required"></span></label>
                            <input class="form-control" type="password" id="verify_pass">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out" name="submit" id="submit_btn"
                                value="Submit">@lang('lang.submit')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- END SECTION SHOP -->
</div>
@endsection

@section('additional_scripts')
<script>
    $("#new_pass").on('change', function(){
        if($(this).val() != ""){
            $("#submit_btn").prop("disabled", true);
        }
        else{
            $("#submit_btn").prop("disabled", false);
        }
    })
    $("#verify_pass").on('change', function(){
        if($(this).val() != $("#new_pass").val() && $("#new_pass").val() != ""){
            $("#submit_btn").prop("disabled", true);
        }
        else{
            $("#submit_btn").prop("disabled", false);
        }
    })
</script>
@endsection