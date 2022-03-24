@extends('layouts.website_layout')

@section('content')
<div class="main_content">
    <!-- START 404 SECTION -->
    <div class="section">
        <div class="error_wrap">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-10 order-lg-first">
                        <div class="text-center">
                            <div class="error_txt">404</div>
                            <h5 class="mb-2 mb-sm-3">oops! The page you requested was not found!</h5>
                            <p>The page you are looking for was moved, removed, renamed or might never existed.</p>
                            <div class="search_form pb-3 pb-md-4">
                                <form method="post">
                                    <input name="text" id="text" type="text" placeholder="Search" class="form-control">
                                    <button type="submit" class="btn icon_search"><i
                                            class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                            <a href="index.html" class="btn btn-fill-out">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END 404 SECTION -->
</div>
@endsection