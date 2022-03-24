@extends('layouts.admin_layout')

@section('content')
<!-- Start content -->

<div class="content">
    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/cities/' . $city->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                @php
                                $baseLocale = App::getLocale();
                                @endphp
                                @foreach ($languages as $language)
                                {{ App::setLocale($language->locale) }}
                                <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">@lang('lang.name')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control"
                                                value="{{ $city->translation->name }}" name="name[]" required>
                                        </div>
                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">@lang('lang.code')</label>
                                    <div class="col-md-10">
                                        <input type="text" name="code" maxlength="4" pattern="[0-9]{1,4}"
                                            oninvalid="setCustomValidity('@lang('lang.validation_error_num')')"
                                            value="{{ $city->code }}" onchange="setCustomValidity('')"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.cities')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="state_id" required>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ $city->state_id == $state->id?"selected":"" }}>
                                                {{ $state->translation->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn waves-effect waves-light btn-primary">@lang('lang.submit')</button>
                </div>
            </div>
        </form>
    </div>
</div> <!-- container -->

</div> <!-- content -->
@endsection