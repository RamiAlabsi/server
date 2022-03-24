@extends('layouts.admin_layout')
@section('additional_css')
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/all.min.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/ionicons.min.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/themify-icons.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/linearicons.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/flaticon.css">
<link rel="stylesheet" href="{{ URL::to('/') }}/public/assets/css/simple-line-icons.css">
@endsection
@section('content')
<!-- Start content -->
<div class="content">
    <div class="container">
        <form class="form-horizontal" role="form"
            action="{{ url(app()->getLocale() . "/admin/website_settings/$page_name") }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            @foreach ($content as $section)
            <div class="row">

                <!-- Section Name -->
                <div class="col-sm-4">
                    <h4 class="page-title">@lang("lang.{$section['trans_key']}")
                        @lang('lang.section'){{ $section['cnt'] }}:</h4>
                    <br>
                </div>

                @if ($section['key'] != "off")
                <!-- Section ON/OFF -->
                <div class="col-sm-8">
                    <div style="text-align: right">
                        on: <input type="radio" name="{{ $section['key'] }}" value="on"
                            {{ $settings["{$section['key']}"] == 1?'checked':'' }}>
                        off: <input type="radio" name="{{ $section['key'] }}" value="off"
                            {{ $settings["{$section['key']}"] == 0?'checked':'' }}>
                    </div>
                </div>
                @endif

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        @foreach ($section['data'] as $item)
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">

                                    <!-- LABEL -->
                                    <div class="col-md-2">
                                        <h4>@lang("lang.{$item['trans_key']}"){{ $item['cnt'] }}</h4>
                                    </div>
                                    <div class="col-md-10">

                                        @if ($item["type"] == "image")
                                        <div class="form-group">
                                            <!-- IMAGE -->
                                            <input type="file" class="filestyle" data-input="false"
                                                name="{{ $item['key'] }}">
                                        </div>
                                         <img src='{{url("/")}}/{{ $settings["{$item['key']}"]}}' />
                                        @elseif($item["type"] == "text")
                                        <!-- TEXT -->
                                        @php ($baseLocale = App::getLocale())
                                        @foreach ($languages as $language)
                                        {{ App::setLocale($language->locale) }}
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"
                                                style="text-align: end">{{ $language->locale }}:</label>
                                            <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="{{ $item['key'] }}[]"
                                                        value="@lang("lang.{$item['key']}")" maxlength="250"
                                                        required />
                                                </div>
                                            </bdo>
                                        </div>
                                        @endforeach
                                        {{ App::setLocale($baseLocale) }}

                                        @elseif($item["type"] == "setting_text")
                                        <!-- TEXT -->
                                        <div class="form-group">
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="{{ $item['key'] }}"
                                                    value="{{ $settings["{$item['key']}"] }}" maxlength="250"
                                                    required />
                                            </div>
                                        </div>

                                        @elseif($item["type"] == "icon")
                                        <!-- ICON -->
                                        <div class="form-group">
                                            <select name="{{ $item['key'] }}" required>
                                                @foreach ($icons as $icon)
                                                <option value="{{ $icon }}"
                                                    {{ $settings["{$item['key']}"] == $icon?'selected':'' }}>
                                                    <i class="{{ $icon }}">{{ $icon }}</i>
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @elseif($item["type"] == "textarea")
                                        <!-- TEXTAREA -->
                                        @php ($baseLocale = App::getLocale())
                                        @foreach ($languages as $language)
                                        {{ App::setLocale($language->locale) }}
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"
                                                style="text-align: end">{{ $language->locale }}:</label>
                                            <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                                <div class="col-md-10">
                                                    <textarea style="width: 100%" name="{{ $item['key'] }}[]">
                                                        @lang("lang.{$item['key']}")
                                                    </textarea>
                                                </div>
                                            </bdo>
                                        </div>
                                        @endforeach
                                        {{ App::setLocale($baseLocale) }}

                                        @elseif($item["type"] == "content")
                                        <!-- CONTENT -->
                                        @php ($baseLocale = App::getLocale())
                                        @foreach ($languages as $language)
                                        {{ App::setLocale($language->locale) }}
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"
                                                style="text-align: end">{{ $language->locale }}:</label>
                                            <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                                <div class="col-md-10">
                                                    <textarea class="elm1" name="{{ $item['key'] }}[]">
                                                        @lang("lang.{$item['key']}")
                                                    </textarea>
                                                </div>
                                            </bdo>
                                        </div>
                                        @endforeach
                                        {{ App::setLocale($baseLocale) }}

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>

            @endforeach
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

<!--form validation init-->
<script src="{{ URL::TO('/') }}/public/admin_assets/plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
            if ($(".elm1").length > 0) {
                tinymce.init({
                    selector: "textarea.elm1",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "rtl insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    }, {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Red header',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    }, {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    }, {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    }, {
                        title: 'Table styles'
                    }, {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }]
                });
            }
        });
</script>

<script src="{{ URL::TO('/') }}/public/admin_assets/pages/jquery.form-advanced.init.js" type="text/javascript"></script>
@endsection