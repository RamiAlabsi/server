@extends('layouts.vendor_layout')

@section('css')
<!-- Plugins css-->
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css"
    rel="stylesheet" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/multiselect/css/multi-select.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/select2/css/select2.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-select/css/bootstrap-select.min.css"
    rel="stylesheet" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css"
    rel="stylesheet" />
    
    <style>
        .options_btns .btn{
            background: #999;
            color: #fff;
        }
        .append_color{
            display:none;
        }
        .append_other{
            display:inline-block;
        }
    </style>
@endsection
@section('content')
<!-- Start content -->
<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/vendor/products/') }}"
            method="POST" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('lang.meta_info'):</h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-10">
                                @php
                                $baseLocale = App::getLocale();
                                @endphp
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.name')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" value="{{ old('name.' . $key) }}"
                                                name="name[]" required>
                                            @error('name.' . $key)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </bdo>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.small_description')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control"
                                                value="{{ old('small_description.' . $key) }}"
                                                name="small_description[]" required>
                                            @error('small_description.' . $key)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </bdo>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.description')</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description[]" required
                                                rows="5">{{ old('description.' . $key) }}</textarea>
                                            @error('description.' . $key)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </bdo>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('lang.choose_images'):</h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                            @for ($i = 0; $i < 4; $i++) <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="file" class="filestyle" value="{{ old('images.' . $i) }}"
                                            data-input="false" name="images[]">
                                        @error('images.' . $i)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.stores'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('lang.stores')</label>
                            <div class="col-md-10">
                                <select multiple="multiple" class="form-control select2" name="stores[]" required>
                                    @foreach ($user_stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->translation->name }}</option>
                                    @endforeach
                                </select>
                                @error('stores')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.expire_date'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('lang.expire')</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" name="expire" required
                                    value="{{ old('name.' . $key) }}">
                                @error('expire')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.min_amount'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('lang.min_amount')</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="min_amount" required
                                    value="{{ old('min_amount.' . $key) }}">
                                @error('min_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.made_in'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('lang.made_in')</label>
                            <div class="col-md-10">
                                <select name="made_in" class="form-control" required>
                                    @foreach ($countries as $country )
                                        <option value="{{ $country->id }}">{{$country->translation->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" name="made_in" required
                                    value="{{ old('made_in.' . $key) }}"> --}}
                                @error('made_in')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  
         <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('lang.brand'):</h4>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
             <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-2 control-label">@lang('lang.brand')</label>
                    <div class="col-md-10">
                        <select name="brand" class="form-control" required>
                            @foreach (\App\Models\Brand::get() as $brand )
                                <option value="{{ $brand->id }}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                   
                        @error('brand')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.price_info'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-md-2 control-label">@lang('lang.price')</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="price" step="0.01" required
                                    value="{{ old('name.' . $key) }}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.categories'):</h4>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <select multiple="multiple" class="multi-select" id="my_multi_select2" name="categories[]"
                            data-plugin="multiselect" data-selectable-optgroup="true">
                            @php
                            echo $categoriesSelectOptions;
                            @endphp
                        </select>
                        @error('categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">@lang('lang.attributes'):</h4>
            <br>
        </div>
    </div>

    <div id="attributes_div">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-11">
                                <h2 class="m-t-0 m-b-30 header-title"><b>@lang('lang.attribute') 1:</b></h2>
                            </div>
                            <div class="col-md-1" style="text-align: center">
                                <button type="button"
                                    class="btn btn-icon waves-effect waves-light btn-danger delete_attribute"> <i
                                        class="fa fa-remove"></i> </button>
                            </div>
                        </div>

                        {{-- left section --}}
                        <div class="col-md-5">
                            <h2 class="m-t-0 m-b-30 header-title"><b>@lang('lang.meta_info'):</b></h2>
                            @foreach ($languages as $language)
                            {{ App::setLocale($language->locale) }}
                            <div dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                <bdo class="form-group">
                                    <label class="col-md-2 control-label">@lang('lang.attribute_name')</label>
                                    <br>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="attribute_names[1][]" required>
                                    </div>
                                </bdo>
                            </div>
                            @endforeach
                            {{ App::setLocale($baseLocale) }}
                        </div>
                        {{--  --}}

                        {{-- right section --}}
                        <div class="col-md-7 mo-test ">
                            <h2 class="m-t-0 m-b-30 header-title"><b>@lang('lang.attribute_options'):</b></h2>
                            <div class="options_btns text-center" style="margin-bottom:20px;">
                                            <label for="color1" class="btn secondry-btn color"data-id=" #sub_attribute_allowed_values_row_1">
                                                <input type="radio" class="d-none" id="color1" name="options[1]" value="color"/>
                                                اللون
                                            </label>
                                            <label for="other1" class="btn secondry-btn other" data-id=" #sub_attribute_allowed_values_row_1">
                                                <input type="radio" class="d-none" id="other1" name="options[1]" value="other"/>
                                                اخري
                                            </label>
                                        </div>
                            <div class="row">
                                <div id="sub_attribute_allowed_values_row_1">
                                    <div class='form-group'>
                                        <label class='col-md-2 control-label' style="text-align: right">@lang('lang.option') 1:</label>
                                        
                                        <div class='col-md-9'>
                                            @foreach ($languages as $language)
                                            {{ App::setLocale($language->locale) }}
                                            <bdo dir='{{ $language->direction == 1?'ltr':'rtl' }}'>
                                                <input type='text' class='form-control input-change' name='allowed_values[1][1][]'
                                                    placeholder="@lang('lang.name')" required>
                                            </bdo>
                                            @endforeach
                                            {{ App::setLocale($baseLocale) }}
                                            <input type='number' class='form-control' name='allowed_values[1][1][]'
                                                placeholder="@lang('lang.additional_price')" required>
                                        </div>
                                        <div class='col-md-1'>
                                            <button type="button"
                                                class="btn btn-icon waves-effect waves-light btn-danger delete_attribute_option">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row"id='sub_attribute_allowed_values_row_1' style="text-align: center">
                                <button style="width: 50%; position: relative;" type="button" onclick="append_color(1)"
                                    class="btn btn-icon waves-effect waves-light btn-primary append_color append_btn">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button style="width: 50%; position: relative;" type="button" onclick="append_other(1)"
                                    class="btn btn-icon waves-effect waves-light btn-primary append_other append_btn">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            
                        </div>
                        {{--  --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn waves-effect waves-light btn-primary"
                id="add_attribute_btn">@lang('lang.add_attribute')</button>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br>
            <button style="width: 50%;position: relative;left: 25%;" type="submit"
                class="btn waves-effect waves-light btn-primary">@lang('lang.submit')</button>
        </div>
    </div>
    </form>
</div>
</div> <!-- container -->

</div> <!-- content -->
@endsection

@section('script')
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/switchery/js/switchery.min.js"></script>
<script type="text/javascript" src="{{URL::TO('/')}}/public/admin_assets/plugins/multiselect/js/jquery.multi-select.js">
</script>
<script type="text/javascript"
    src="{{URL::TO('/')}}/public/admin_assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-select/js/bootstrap-select.min.js"
    type="text/javascript"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"
    type="text/javascript"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"
    type="text/javascript"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"
    type="text/javascript"></script>

<script type="text/javascript" src="{{URL::TO('/')}}/public/admin_assets/plugins/autocomplete/jquery.mockjax.js">
</script>
<script type="text/javascript"
    src="{{URL::TO('/')}}/public/admin_assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="{{URL::TO('/')}}/public/admin_assets/plugins/autocomplete/countries.js"></script>
<script type="text/javascript" src="{{URL::TO('/')}}/public/admin_assets/pages/autocomplete.js"></script>

<script type="text/javascript" src="{{URL::TO('/')}}/public/admin_assets/pages/jquery.form-advanced.init.js"></script>

<script>
    var names_cnt = [];
    names_cnt[1] = 2;
    var attribute_id = 1;
    
    function append_color(attribute_id) {
        
        $("#sub_attribute_allowed_values_row_"+attribute_id+"").append("\
                <div class='form-group mo-test'>\
                    <label class='col-md-2 control-label' style='text-align: right'>@lang('lang.option') " + names_cnt[attribute_id] + ":</label>\
                    <div class='col-md-9'>\
                        @foreach ($languages as $language)\
                        {{ App::setLocale($language->locale) }}\
                        <bdo dir='{{ $language->direction == 1?'ltr':'rtl' }}'>\
                            <input type='color' class='form-control input-change' name='allowed_values[" + attribute_id + "][" + names_cnt[attribute_id] + "][]'\
                                placeholder='@lang('lang.name')' required>\
                        </bdo>\
                        @endforeach\
                        {{ App::setLocale($baseLocale) }}\
                        <input type='number' class='form-control' name='allowed_values[" + attribute_id + "][" + names_cnt[attribute_id] + "][]'\
                            placeholder='@lang('lang.additional_price')' required>\
                    </div>\
                    <div class='col-md-1'>\
                        <button type='button'\
                            class='btn btn-icon waves-effect waves-light btn-danger delete_attribute_option'>\
                            <i class='fa fa-remove'></i>\
                        </button>\
                    </div>\
                </div>");
        names_cnt[attribute_id] = names_cnt[attribute_id] + 1;
    }
    
    function append_other(attribute_id) {
    $("#sub_attribute_allowed_values_row_"+attribute_id+"").append("\
            <div class='form-group mo-test'>\
                <label class='col-md-2 control-label' style='text-align: right'>@lang('lang.option') " + names_cnt[attribute_id] + ":</label>\
                <div class='col-md-9'>\
                    @foreach ($languages as $language)\
                    {{ App::setLocale($language->locale) }}\
                    <bdo dir='{{ $language->direction == 1?'ltr':'rtl' }}'>\
                        <input type='text' class='form-control input-change' name='allowed_values[" + attribute_id + "][" + names_cnt[attribute_id] + "][]'\
                            placeholder='@lang('lang.name')' required>\
                    </bdo>\
                    @endforeach\
                    {{ App::setLocale($baseLocale) }}\
                    <input type='number' class='form-control' name='allowed_values[" + attribute_id + "][" + names_cnt[attribute_id] + "][]'\
                        placeholder='@lang('lang.additional_price')' required>\
                </div>\
                <div class='col-md-1'>\
                    <button type='button'\
                        class='btn btn-icon waves-effect waves-light btn-danger delete_attribute_option'>\
                        <i class='fa fa-remove'></i>\
                    </button>\
                </div>\
            </div>");
        names_cnt[attribute_id] = names_cnt[attribute_id] + 1;
    }
    
    $(document).ready(function(){
        var attributes_cnt = 2;
        var append_attribute = function(){
            names_cnt[attributes_cnt] = 2;
            $("#attributes_div").append("\
                <div class='row' class='attribute_div'>\
                    <div class='col-sm-12'>\
                        <div class='card-box'>\
                            <div class='row'>\
                                <div class='row'>\
                            <div class='col-md-11'>\
                                <h2 class='m-t-0 m-b-30 header-title'><b>@lang('lang.attribute') " + attributes_cnt + ":</b></h2>\
                            </div>\
                            <div class='col-md-1' style='text-align: center'>\
                                <button type='button' class='btn btn-icon waves-effect waves-light btn-danger delete_attribute'> <i\
                                        class='fa fa-remove'></i> </button>\
                            </div>\
                                </div>\
                                {{-- left section --}}\
                                <div class='col-md-5'>\
                                    <h2 class='m-t-0 m-b-30 header-title'><b>@lang('lang.meta_info'):</b></h2>\
                                    @foreach ($languages as $language)\
                                    {{ App::setLocale($language->locale) }}\
                                    <div dir='{{ $language->direction == 1?'ltr':'rtl' }}'>\
                                        <bdo class='form-group'>\
                                            <label class='col-md-2 control-label'>@lang('lang.attribute_name')</label>\
                                            <div class='col-md-10'>\
                                                <input type='text' class='form-control' name='attribute_names[" + attributes_cnt + "][]'\
                                                    required>\
                                            </div>\
                                        </bdo>\
                                    </div>\
                                    @endforeach\
                                    {{ App::setLocale($baseLocale) }}\
                                </div>\
                                {{--  --}}\
                                {{-- right section --}}\
                                <div class='col-md-7 mo-test'>\
                                            <div class='options_btns text-center' style='margin-bottom:20px;'>\
                                           <h2 class='m-t-0 m-b-30 header-title'><b>@lang('lang.attribute_options'):</b></h2>\
                                               <div class='options_btns text-center' style='margin-bottom:20px;'>\
                                            <label for='color"+attributes_cnt+"' class='btn secondry-btn color' data-id='#sub_attribute_allowed_values_row_"+attributes_cnt+"'>\
                                                <input type='radio' class='d-none' id='color"+attributes_cnt+"' name='options[" + attributes_cnt + "]' value='color'/>\
                                                اللون</label>\
                                            <label for='other"+attributes_cnt+"' class='btn secondry-btn other'  data-id='#sub_attribute_allowed_values_row_"+attributes_cnt+"'>\
                                                <input type='radio' class='d-none' id='other"+attributes_cnt+"' name='options["+ attributes_cnt +"]' value='other'/>\
                                                اخري</label>\
                                        </div>\
                                    <div class='row'>\
                                        <div id='sub_attribute_allowed_values_row_"+ attributes_cnt +"' >\
                                            <div class='form-group '>\
                                                <label class='col-md-2 control-label' style='text-align: right'>@lang('lang.option') 1:</label>\
                                                <div class='col-md-9'>\
                                                    @foreach ($languages as $language)\
                                                    {{ App::setLocale($language->locale) }}\
                                                    <bdo dir='{{ $language->direction == 1?'ltr':'rtl' }}'>\
                                                        <input type='text' class='form-control input-change' name='allowed_values[" + attributes_cnt + "][1][]'\
                                                            placeholder='@lang('lang.name')' required>\
                                                    </bdo>\
                                                    @endforeach\
                                                    {{ App::setLocale($baseLocale) }}\
                                                    <input type='number' class='form-control' name='allowed_values[" + attributes_cnt + "][1][]'\
                                                        placeholder='@lang('lang.additional_price')' required>\
                                                </div>\
                                                <div class='col-md-1'>\
                                                    <button type='button'\
                                                        class='btn btn-icon waves-effect waves-light btn-danger delete_attribute_option'>\
                                                        <i class='fa fa-remove'></i>\
                                                    </button>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <hr>\
                                    <div class='row'id='sub_attribute_allowed_values_row_"+attributes_cnt+"' style='text-align: center'>\
                                        <button style='width: 50%; position: relative;' type='button'\
                                            class='btn btn-icon waves-effect waves-light btn-primary append_other'\
                                            onclick='append_other(" + attributes_cnt + ")'>\
                                            <i class='fa fa-plus'></i>\
                                        </button>\
                                          <button style='width: 50%; position: relative;' type='button' onclick='append_color("+attributes_cnt+")'\
                                    class='btn btn-icon waves-effect waves-light btn-primary append_color append_btn'>\
                                    <i class='fa fa-plus'></i>\
                                </button>\
                                    </div>\
                                </div>\
                                {{--  --}}\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            ");

            attributes_cnt++;
        };

        $("#add_attribute_btn").click(append_attribute);

        $(document).on('click', '.delete_attribute', function() {
            $(this).parents('div')[5].remove();
        });
        $(document).on('click', '.delete_attribute_option', function() {
            $(this).parents('div')[1].remove();
        });
  
    });
      $(document).on("click", "label.color" , function() {
        var input=$(this).attr('data-id');
        $(input).find('.input-change').attr('type','color');
        $(input).find('.append_color').show();
        $(input).find('.append_other').hide();
    });
       $(document).on("click", "label.other" , function() {
        var input=$(this).attr('data-id');
        $(input).find('.input-change').attr({ type: 'text', value: '' });
           $(input).find('.append_color').hide();
        $(input).find('.append_other').show();
    });

    
</script>

@endsection