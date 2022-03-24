@extends('layouts.website_layout')

@section('content')
<div class="main_content">
    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive wishlist_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-stock-status">Stock Status</th>
                                    <th class="product-add-to-cart"></th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function loadFavourites(){
        $.ajax({
            url: "{{ url('ajax/favourites/load') }}",
            type: "GET",
            success: function(data){
                // console.log("success");
                // console.log(data);
                $('tbody').html(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }
</script>
<script>
    function removeFavourite(element){
        $.ajax({
            url: "{{ url(app()->getLocale() . '/ajax/favourites/toggle') }}",
            type: "POST",
            data:{
                _token: "{{ csrf_token() }}",
                product_id: element.data("product_id")
            },
            success: function(data){
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
        loadFavourites();
        return false;
    }
    loadFavourites();
</script>
@endsection