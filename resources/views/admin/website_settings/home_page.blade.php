@extends('layouts.admin_layout')
@section('css')

<link href="{{ URL::TO('/') }}/public/admin_assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{ URL::TO('/') }}/public/admin_assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

@endsection
@section('content')
<!-- Start content -->
<div class="content">
    <div class="container">

        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/home_page_settings/') }}"
            method="POST" enctype="multipart/form-data">
            @csrf

                 <!-- Newest Products Section -->
                 <div class="row">
                <div class="col-sm-4">
                    <h4 class="page-title">@lang('lang.index_side_category_on'):</h4>
                    <br>
                </div>
                <div class="col-sm-8">
                    <div style="text-align: right">
                        on: <input type="radio" name="index_side_category_on" value="on"
                            {{ $settings['index_side_category_on'] == 1?'checked':'' }}>
                        off: <input type="radio" name="index_side_category_on" value="off"
                            {{ $settings['index_side_category_on'] == 0?'checked':'' }}>
                    </div>
                </div>
            
            </div>

            <div class="card-box">
                <div class="container">
                            <div class="row">
                              <div class="form-group">
                                <select multiple="multiple" class="multi-select" id="my_multi_select1" name="cat_side[]" data-plugin="multiselect">
                               <?php $side_cats= \App\Models\Setting::where('key','index_side_category_on')->first()->cats->pluck('id')->toArray()?>
                                @foreach(\App\Models\Category::get() as $cat)
                                <option value="{{$cat->id}}"{{in_array($cat->id,$side_cats)?'selected':''}} >{{$cat->translation->name}}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                  </div>
                </div>
            <!-- Newest Products Section -->
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="page-title">@lang('lang.newest_products_section'):</h4>
                    <br>
                </div>
                <div class="col-sm-8">
                    <div style="text-align: right">
                        on: <input type="radio" name="index_newest_products_section_on" value="on"
                            {{ $settings['index_newest_products_section_on'] == 1?'checked':'' }}>
                        off: <input type="radio" name="index_newest_products_section_on" value="off"
                            {{ $settings['index_newest_products_section_on'] == 0?'checked':'' }}>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="page-title">@lang('lang.features_section'):</h4>
                    <br>
                </div>
                <div class="col-sm-8">
                    <div style="text-align: right">
                        on: <input type="radio" name="index_features_on" value="on"
                            {{ $settings['index_features_on'] == 1?'checked':'' }}>
                        off: <input type="radio" name="index_features_on" value="off"
                            {{ $settings['index_features_on'] == 0?'checked':'' }}>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        @for ($i = 1; $i < 4; $i++) <div class="row">
                            <div class="col-md-2">
                                <h4>@lang('lang.feature'){{ $i }}:</h4>
                            </div>
                            <div class="col-md-8">
                                @php ($baseLocale = App::getLocale())
                                @foreach ($languages as $language)
                                {{ App::setLocale($language->locale) }}
                                <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"
                                            style="text-align: end">@lang('lang.text'):</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" maxlength="25"
                                                name="index_features_text{{ $i }}[]" required
                                                value="@lang('lang.index_features_text' . $i)" />
                                        </div>
                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}
                                <div class="form-group">
                                    <label class="col-md-2 control-label"
                                        style="text-align: end">@lang('lang.icon'):</label>
                                    <div class="col-md-10">
                                        <select name="index_feature_icon{{ $i }}_class" required>
                                            <option value="fab fa-cc-visa"
                                                {{ $settings['index_feature_icon' . $i . '_class'] == 'fab fa-cc-visa'?'selected':'' }}>
                                                <i class="fab fa-cc-visa">fab fa-cc-visa</i>
                                            </option>
                                            <option value="fas fa-life-ring"
                                                {{ $settings['index_feature_icon' . $i . '_class'] == 'fas fa-life-ring'?'selected':'' }}>
                                                <i class="fas fa-life-ring">fas fa-life-ring</i>
                                            </option>
                                            <option value="fas fa-money-bill-alt"
                                                {{ $settings['index_feature_icon' . $i . '_class'] == 'fas fa-money-bill-alt'?'selected':'' }}>
                                                <i class="fas fa-money-bill-alt">fas fa-money-bill-alt</i>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Ads Section -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('lang.ads_section'):</h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-2">
                                <h4>@lang('lang.main_ad'):</h4>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="filestyle" data-input="false" name="index_main_ad">
                            </div>
                            <div class="col-md-2" style="text-align: right">
                                on: <input type="radio" name="index_main_ad_section_on" value="on"
                                    {{ $settings['index_main_ad_section_on'] == 1?'checked':'' }}>
                                off: <input type="radio" name="index_main_ad_section_on" value="off"
                                    {{ $settings['index_main_ad_section_on'] == 0?'checked':'' }}>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                @for ($i = 1; $i < 3; $i++) <div class="row">
                                    <div class="col-md-2">
                                        <h4>@lang('lang.sub_ad'){{ $i }}:</h4>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="file" class="filestyle" data-input="false" name="index_sub_ad{{ $i }}_url">
                                    </div>
                            </div>
                            @endfor
                        </div>
                        <div class="col-md-2" style="text-align: right">
                            on: <input type="radio" name="index_sub_ad_section_on" value="on"
                                {{ $settings['index_sub_ad_section_on'] == 1?'checked':'' }}>
                            off: <input type="radio" name="index_sub_ad_section_on" value="off"
                                {{ $settings['index_sub_ad_section_on'] == 0?'checked':'' }}>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <button type="submit" class="btn waves-effect waves-light btn-primary">@lang('lang.save')</button>
    </form>
</div>
</div> <!-- container -->

</div> <!-- content -->
@endsection

@section('script')

<script src="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"
    type="text/javascript"></script>

<script src="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"
    type="text/javascript"></script>
<script src="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"
    type="text/javascript"></script>
<script src="{{ URL::TO('/') }}/public/admin_assets/pages/jquery.form-advanced.init.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ URL::TO('/') }}/public/admin_assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="{{ URL::TO('/') }}/public/admin_assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="{{ URL::TO('/') }}/public/admin_assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="{{ URL::TO('/') }}/public/admin_assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
@endsection