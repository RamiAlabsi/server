@extends('layouts.vendor_layout')

@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" action="{{ url(app()->getLocale() . '/vendor/stores/')  }}" method="POST" role="form">
            @csrf
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
                                            <input type="text" name="name[]" class="form-control"
                                                placeholder="@lang('lang.name')" required>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-md-2 control-label">@lang('lang.description')</label>
                                        <div class="col-md-10">
                                            <input type="text" name="description[]" class="form-control"
                                            placeholder="@lang('lang.description')" required>
                                        </div>

                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.email')</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" placeholder="@lang('lang.email')" required value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.phone')</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="phone" class="form-control" placeholder="@lang('lang.phone')" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
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
