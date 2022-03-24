@extends('layouts.admin_layout')


@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/category_sales/') }}"
            method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- ///////////////////// //////////////// CATEGORIES //////////////// /////////////////// //////////////// --}}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.category')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="category_id" required value="{{ old('category_id') }}">
                                            <option disabled selected></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->translation->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ///////////////////// //////////////// DISCOUNT RATE //////////////// /////////////////// //////////////// --}}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('lang.discount_rate')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="discount_rate" required value="{{ old('discount_rate') }}">
                                            <option disabled selected></option>
                                            @for ($i = 0; $i < 100; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                        </select>
                                        @error('discount_rate')
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
            <button type="submit" class="btn waves-effect waves-light btn-primary">@lang('lang.submit')</button>
        </form>
    </div>
</div> <!-- container -->

</div> <!-- content -->
@endsection
