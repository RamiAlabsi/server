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
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: -100px auto 20px;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f303";
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        display: inline-block;
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #eeeeee;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        margin: auto;
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
        .options_btns .btn{
            background: #999;
            color: #fff;
        }
        .hide{
            display:none;
        }
        
</style>
@endsection
@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form"
            action="{{ url(app()->getLocale() . '/vendor/products/' . $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('lang.meta_info'):</h4>
                    <br>
                </div>
            </div>
            {{-- /////////////////////// ///////////////////////// META INFORMATION ROW /////////////////////// /////////////////////// --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-10">
                                {{-- /////////// Saving base locale /////////////// --}}
                                @php
                                $baseLocale = App::getLocale();
                                @endphp
                                {{-- /////////// Name /////////////// --}}
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.name')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name[]"
                                                value="{{ $product->translation->name }}" required>
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
                                {{-- /////////// Small Description /////////////// --}}
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.small_description')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control"
                                                value="{{ $product->translation->small_description }}"
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
                                {{-- /////////// Description /////////////// --}}
                                <div class="form-group">
                                    @foreach ($languages as $key => $language)
                                    {{ App::setLocale($language->locale) }}
                                    <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                        <label class="col-md-2 control-label">@lang('lang.description')</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description[]" required
                                                rows="5">{{ $product->translation->description }}</textarea>
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
            {{-- /////////////////////// ///////////////////////// IMAGES ROW /////////////////////// /////////////////////// --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($product->images as $product_image_key => $image)
                                
                                <div class="profile-image">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' class="imageUpload" accept=".png, .jpg, .jpeg" name="images[]" />
                                            <label for="imageUpload">
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div class="imagePreview"
                                                style="background-image: url({{ url("{$image->image_url}") }})">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @for ($i = $product_image_key + 1; $i < 4; $i++) 
                                <div class="profile-image">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' class="imageUpload" accept=".png, .jpg, .jpeg" name="images[]" />
                                            <label for="imageUpload">
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div class="imagePreview" style="background-image: url()">
                                            </div>
                                        </div>
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
                                        <select multiple="multiple" class="form-control select2" name="stores[]"
                                            required>
                                            @foreach ($user_stores as $store)
                                            <option value="{{ $store->id }}"
                                                {{ in_array($store->id, $product_stores_list)?"selected":"" }}>
                                                {{ $store->translation->name }}</option>
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
                                            value="{{ !is_null( $product->expire_date ) ? Illuminate\Support\Carbon::parse($product->expire_date)->format('Y-m-d') : '' }}">
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
                                            value="{{ $product->min_amount }}">
                                        {{-- {{ dd($product) }} --}}
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
                                                <option value="{{ $country->id }}" {{ $product->made_in == $country->id ? 'selected' : '' }}>{{$country->translation->name}}</option>
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
                                                <option value="{{ $brand->id }}"{{ $product->barnd_id == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
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
                                            value="{{ $product->price }}">
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
                                <select multiple="multiple" class="multi-select" id="categories_select"
                                    name="categories[]" data-plugin="multiselect" data-selectable-optgroup="true">
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
              
                @foreach ($product->attributes as $attribute_foreach_key => $attribute)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h2 class="m-t-0 m-b-30 header-title"><b>@lang('lang.attribute')
                                                {{ $attribute_foreach_key + 1 }}:</b></h2>
                                    </div>
                                    <div class="col-md-1" style="text-align: center">
                                        <button type="button"
                                            class="btn btn-icon waves-effect waves-light btn-danger delete_attribute">
                                            <i class="fa fa-remove"></i> </button>
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
                                                <input type="text" class="form-control"
                                                    name="attribute_names[{{ $attribute_foreach_key + 1 }}][]" required
                                                    value="{{ $attribute->translation->name }}">
                                            </div>
                                        </bdo>
                                    </div>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                                {{--  --}}

                                {{-- right section --}}
                                <div class="col-md-7 mo-test">
                                    <h2 class="m-t-0 m-b-30 header-title"><b>@lang('lang.attribute_options'):</b></h2>
                                    <div class="text-center filter_btns" style="margin-bottom:20px;">
                                             <div class="options_btns text-center" style="margin-bottom:20px;">
                                            <label for="color1" class="btn secondry-btn color"data-id=" #sub_attribute_allowed_values_row_1">
                                                <input type="radio" class="d-none" id="color1" {{$attribute->attribute_type_id==5?"checked":""}} name="options[{{ $attribute_foreach_key + 1 }}]" value="color"/>
                                                اللون
                                            </label>
                                            <label for="other1" class="btn secondry-btn other" data-id=" #sub_attribute_allowed_values_row_1">
                                                <input type="radio" class="d-none" id="other1" {{$attribute->attribute_type_id!=5?"checked":""}} name="options[{{ $attribute_foreach_key + 1 }}]" value="other"/>
                                                اخري
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 " >
                                            <div class="">
                                                <div id="sub_attribute_allowed_values_row_{{ $attribute_foreach_key + 1 }}">
                                                    @foreach ($attribute->allowed_values as $allowed_value_foreach_key =>
                                                    $allowed_value)
                                                    <div class='form-group'>
                                                        <label class='col-md-2 control-label'
                                                            style="text-align: right">@lang('lang.option')
                                                            {{ $allowed_value_foreach_key + 1 }}:</label>
                                                        <div class='col-md-9'>
                                                            @foreach ($languages as $language)
                                                            {{ App::setLocale($language->locale) }}
                                                            <bdo dir='{{ $language->direction == 1?'ltr':'rtl' }}'>
                                                                <input type='{{$attribute->attribute_type_id==5?'color':'text'}}' class='form-control'
                                                                    name='allowed_values[{{ $attribute_foreach_key + 1 }}][{{ $allowed_value_foreach_key + 1 }}][]'
                                                                    placeholder="@lang('lang.name')" required
                                                                    value="{{ $allowed_value->translation->value }}">
                                                            </bdo>
                                                            @endforeach
                                                            {{ App::setLocale($baseLocale) }}
                                                              
                                                            <input type='number' class='form-control'
                                                                name='allowed_values[{{ $attribute_foreach_key + 1 }}][{{ $allowed_value_foreach_key + 1 }}][]'
                                                                placeholder="@lang('lang.additional_price')" required
                                                                value="{{ $allowed_value->price }}">
                                                        </div>
                                                        <div class='col-md-1'>
                                                            <button type="button"
                                                                class="btn btn-icon waves-effect waves-light btn-danger delete_attribute_option">
                                                                <i class="fa fa-remove"></i>
                                                            </button>
                                                        </div>
                                            </div>
                                                    @endforeach
                                                </div>
                                                <div class="row" style="text-align: center">
                                                                  
                                                               <button style="width: 50%; position: relative;" type="button" onclick="append_color({{ $attribute_foreach_key + 1 }})"
                                    class="btn btn-icon waves-effect waves-light btn-primary append_color append_btn {{$attribute->attribute_type_id!=5?'hide':''}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button style="width: 50%; position: relative;" type="button" onclick="append_other({{ $attribute_foreach_key + 1 }})"
                                    class="btn btn-icon waves-effect waves-light btn-primary append_other append_btn {{$attribute->attribute_type_id==5?'hide':''}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                                                </div>
                                            </div>
                          
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    
                                </div>
                                {{--  --}}

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
</script>
@foreach ($product->attributes as $key => $attribute)
    <script>
        names_cnt[{{ $key + 1 }}] = {{ count($attribute->allowed_values) + 1 }};
    </script>
@endforeach
<script>
  
    
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
                                                <input type='radio' class='d-none' id='other"+attributes_cnt+"' checked name='options["+ attributes_cnt +"]' checked value='other'/>\
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
                                    class='btn btn-icon waves-effect waves-light btn-primary append_color append_btn hide'>\
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // console.log(input.parents("div"));
                // input.closest('.imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('.imagePreview').hide();
                $('.imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".imageUpload").change(function () {
        readURL(this);
    });
</script>
<script>
    // selecting the categories
    var old_categories = {{ json_encode($product_categories_list) }};
    // console.log(old_categories);
    old_categories.forEach(old_category_id => {
        $('#categories_select option[value=' + old_category_id + ']').attr('selected', true); 
    });
</script>

<script>
        /* =============================== Settings of content tabs =============================== */
    $('.filter_btns .btn').on('click', function(e) {

        e.preventDefault();

        $(this).addClass('active').siblings().removeClass('active');

        var id = $(this).attr('data-content')

        $('.filter_attr .box-content[id="' + id + '"]').addClass('active').siblings().removeClass('active')

    })
</script>

@endsection