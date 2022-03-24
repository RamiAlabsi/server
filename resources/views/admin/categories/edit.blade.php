@extends('layouts.admin_layout')

@section('content')
<!-- Start content -->

<div class="content">

    <div class="container">
        <form class="form-horizontal" role="form"
            action="{{ url(app()->getLocale() . '/admin/categories/' . $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                                    <input type="file" class="filestyle" data-input="false" name="image" value="{{ old('image') }}">
                                    </div>     
                               @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                <label class="col-md-2 control-label">@lang('lang.category Type')</label>
                                    <div class="col-md-10">
                                   <select class="form-control" name='special'>
                                   <option value="0"{{$category->main==0?'selected':''}}>@lang('lang.normal')</option>
                                   <option value="1"{{$category->main==1?'selected':''}}>@lang('lang.special')</option>
                                   </select>
                                    </div>
                                @error('special')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
               
                                
                    
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
                                            <input type="text" class="form-control" name="name[]"
                                                value="{{ $category->translation->name }}" required>
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