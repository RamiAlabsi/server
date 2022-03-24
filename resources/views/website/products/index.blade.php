@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm" id="sortBy"
                                            onchange="getProductsList()">
                                            <option value="default" selected>@lang('lang.default')</option>
                                            {{-- <option value="popularity">Sort by popularity</option> --}}
                                            <option value="date">@lang('lang.sort_by_newness')</option>
                                            <option value="price_asc">@lang('lang.sort_by_price_low_to_high')</option>
                                            <option value="price_desc">@lang('lang.sort_by_price_high_to_low')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:Void(0);" class="shorting_icon grid"><i
                                                class="ti-view-grid"></i></a>
                                        <a href="javascript:Void(0);" class="shorting_icon list active"><i
                                                class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm" id="pagination"
                                            onchange="getProductsList()">
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="productsListDiv">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->
</div>
@endsection

@section('additional_scripts')
<!-- ajax code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function toggleCart(product_id){
        if ("{{ Auth::check() }}" == "") {
            Swal.fire({
                icon: "error",
                title: "@lang('lang.alert_not_auth')",
                text: "@lang('lang.alert_login')"
            });
        } else {
            $.ajax({
            type: 'POST',
            url: "{{ url(app()->getLocale() . '/ajax/cart/toggle') }}",
            data: {
                _token:"{{ csrf_token() }}",
                product_id: product_id,
                quantity: 1
            },
            success: function(data) {
                console.log('product added to log successfully');
                getProductsList();
                console.log(data);
            },
            error: function(data) {
                console.log('error');
                console.log(data);
            }
        });
        }
    }
    function toggleFavourite(product_id){
        if ("{{ Auth::check() }}" == "") {
            Swal.fire({
                icon: "error",
                title: "@lang('lang.alert_not_auth')",
                text: "@lang('lang.alert_login')"
            });
        } else {
            $.ajax({
            type: 'POST',
            url: "{{ url(app()->getLocale() . '/ajax/favourites/toggle') }}",
            data: {
                _token:"{{ csrf_token() }}",
                product_id: product_id
            },
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log('error');
                console.log(data);
            }
        });
        }
    }
    $('.pr_action_btn li a').on('click', function() {
        $(this).find('i').toggleClass('active');
        console.log('hhello')
    })
    function getProductsList (page_num = 1) {
        var pagination = document.getElementById('pagination').value;
        var sortBy = document.getElementById('sortBy').value;

        $.ajax({
            type: 'GET',
            url: "{{ url(app()->getLocale() . '/ajax/products') }}",
            data: {
                pagination: pagination,
                sortBy: sortBy,
                page_num: page_num,
                search_text: "{{ $search_text }}",
                category_id: "{{ $category_id }}",
                discount_rate: "{{ $discount_rate }}"
            },
            success: function(data) {
                document.getElementById('productsListDiv').innerHTML = data;
                console.log(data);
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
    }
    $(document).ready(function() {
        getProductsList();
    });
</script>
@endsection