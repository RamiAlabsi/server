@extends('layouts.website_layout')

@section('content')
<section class="order-details body-inner">
    <div class="container">
        <div class="row">
            <!-- Col -->
            <div class="col-md-7 col-sm-12">
                <div class="title">
                    <h3>@lang('lang.customer_details')</h3>
                </div>
                <div class="row inner-details">
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.first_name')</span>
                            <h4>{{ $order->first_name }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.last_name')</span>
                            <h4>{{ $order->last_name }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.company_name')</span>
                            <h4>{{ $order->company_name }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.ciy_name')</span>
                            <h4>{{ $order->city->translation->name }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.address')</span>
                            <h4>{{ $order->address }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.postcode')</span>
                            <h4>{{ $order->postcode }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.phone')</span>
                            <h4>{{ $order->phone }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.email')</span>
                            <h4>{{ $order->email }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-12 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.notes')</span>
                            <h4>{{ $order->notes }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.payment_status')</span>
                            @if ($order->paid == 1)
                            <h4>@lang('lang.paid')</h4>
                            @else
                            <h4>@lang('lang.not_paid')</h4>
                            @endif
                        </div>
                    </div>
                    <!-- /Col -->
                    <!-- Col -->
                    <div class="col-md-6 col-sm-12">
                        <div class="item">
                            <span>@lang('lang.date')</span>
                            <h4>{{ $order->created_at->format('d-m-Y') }}</h4>
                        </div>
                    </div>
                    <!-- /Col -->
                </div>
            </div>
            <!-- /Col -->
            <!-- Col -->
            <div class="col-md-5 col-sm-12"></div>
            <!-- /Col -->


            <!-- Col -->
            <div class="col-md-12">
                <div class="title">
                    <h3>@lang('lang.orders')</h3>
                </div>
                <div class="row orders-details">

                    @php
                    $order_items = array();
                    if(Auth::user()->id == $order->user_id || Auth::user()->is_admin){
                    $order_items = $order->items;
                    }
                    else{
                    $order_items = $order->getMyItems();
                    }
                    foreach ($order_items as $order_item) {
                    echo $order_item->translation->html;
                    }
                    @endphp

                </div>
            </div>
            <!-- /Col -->
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
<script>
    var order_items_status = [];
    @foreach ($order->items as $order_item)
        order_items_status["{{ $order_item->id }}"] = "{{ $order_item->status->translation->name }}";
    @endforeach
    $('.status_h5').each(function(){
            var order_item_id = $(this).data("order_item_id");
            $(this).text(order_items_status[order_item_id]);
        });
</script>
@endsection