@extends('layouts.vendor_layout')

@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form">
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
                                                value="{{ $store->translation->name }}" disabled>
                                        </div>

                                        <label class="col-md-2 control-label">@lang('lang.description')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control"
                                                value="{{ $store->translation->description }}" disabled>
                                        </div>

                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.email')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $store->email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.phone')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ $store->phone }}" disabled>
                                    </div>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.owners'): </label>
                                    <div class="col-sm-10">
                                        @foreach ($store->users as $owner)
                                        <p>{{ $owner->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- container -->

</div> <!-- content -->
@endsection
