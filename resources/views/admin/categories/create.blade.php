@extends('layouts.admin_layout')

@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form" action="{{ url(app()->getLocale() . '/admin/categories/') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="parent_category_id" value="{{ $level_category_id }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-md-2 control-label">@lang('lang.category icon')</label>
                            <div class="col-md-10">
                                   <select class="form-control" name='icon'>
                                       @foreach($icons as $icon)
                                   <option value="{{$icon}}">{{$icon}}</option>
                                   @endforeach
                                   </select>
                                @error('special')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <br>
                            {{-- ///////////////////// //////////////// IMAGE //////////////// /////////////////// //////////////// --}}
                                <div class="form-group row">
                                    <label class="col-md-2 control-label">@lang('lang.image')</label>
                                    <div class="col-md-10">
                                    <input type="file" class="filestyle" data-input="false" name="image" value="{{ old('image') }}" required>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                </div>
                            <div class="form-group row">
                            <label class="col-md-2 control-label">@lang('lang.category type')</label>
                            <div class="col-md-10">
                                   <select class="form-control" name='special'>
                                   <option value="0">@lang('lang.normal')</option>
                                   <option value="1">@lang('lang.special')</option>
                                   </select>
                                @error('special')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                </div>
                        
                          <br>
                 

                              
                            </div>
                        </div>
                        <div class="row">
                         <div class="col-md-6">
                         {{-- ///////////////////// ////// Category Name in all languages //////////////////// //////////////// --}}
                                @php
                                $baseLocale = App::getLocale();
                                @endphp
                                @foreach ($languages as $language)
                                {{ App::setLocale($language->locale) }}
                                <bdo dir="{{ $language->direction == 1?"ltr":"rtl" }}">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">@lang('lang.name')</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name[]" required>
                                        </div>
                                    </div>
                                </bdo>
                                @endforeach
                                {{ App::setLocale($baseLocale) }}
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
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"
    type="text/javascript"></script>

@endsection