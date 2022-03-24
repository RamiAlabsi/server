@extends('layouts.admin_layout')

@section('content')
<!-- Start content -->

<div class="content">
    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/states/' . $state->id) }}"
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
                                                value="{{ $state->translation->name }}" name="name[]" required>
                                        </div>
                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}
                                <div class="form-group">
                                    <label class="col-md-2 control-label">@lang('lang.code')</label>
                                    <div class="col-md-10">
                                        <input type="text" name="code" value="{{ $state->code }}" maxlength="4"
                                            pattern="[0-9]{1,4}"
                                            oninvalid="setCustomValidity('@lang('lang.validation_error_num')')"
                                            onchange="setCustomValidity('')" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.countries')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="country_id" required>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $state->country_id == $country->id?"selected":"" }}>
                                                {{ $country->translation->name }}
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