@extends('layouts.admin_layout')


@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/faq/' . $faq->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">

                            {{-- ///////////////////// //////////////// QUESTION //////////////// /////////////////// //////////////// --}}
                            <div class="form-group">
                                <label class="col-sm-1 control-label">@lang('lang.question'):</label>
                                <div class="col-sm-11">
                                    @php ($baseLocale = App::getLocale())
                                    @foreach ($languages as $language)
                                    {{ App::setLocale($language->locale) }}
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"
                                            style="text-align: end">{{ $language->locale }}:</label>
                                        <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="question[]"
                                                    maxlength="250" required value="{{ $faq->translation->question }}" />
                                            </div>
                                        </bdo>
                                    </div>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            {{-- ///////////////////// //////////////// ANSWER //////////////// /////////////////// //////////////// --}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('lang.question_type'):</label>
                                <div class="col-sm-10">
                                    <select name="general_question" required>
                                        <option value="1" {{ $faq->general_question?"selected":"" }}>@lang('lang.general_questions')</option>
                                        <option value="0" {{ $faq->general_question?"":"selected" }}>@lang('lang.other_questions')</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">

                            {{-- ///////////////////// //////////////// ANSWER //////////////// /////////////////// //////////////// --}}
                            <div class="form-group">
                                <label class="col-sm-1 control-label">@lang('lang.answer'):</label>
                                <div class="col-sm-11">

                                    @foreach ($languages as $language)
                                    {{ App::setLocale($language->locale) }}
                                    <div class="form-group">
                                        <label class="col-md-1 control-label"
                                            style="text-align: end">{{ $language->locale }}:</label>
                                        <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                            <div class="col-md-11">
                                                <textarea style="width:100%" class="elm1" name="answer[]" required>
                                                    {{ $faq->translation->answer }}
                                                    </textarea>
                                            </div>
                                        </bdo>
                                    </div>
                                    @endforeach
                                    {{ App::setLocale($baseLocale) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn waves-effect waves-light btn-primary">@lang('lang.submit')</button>
        </form>
    </div>
</div> <!-- container -->

</div> <!-- content -->
@endsection

@section('script')
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
@endsection