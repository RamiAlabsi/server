@extends('layouts.website_layout')

@section('content')
<div class="main_content">

    <!-- STAT SECTION FAQ -->
    <div class="section">
        <div class="container" style="text-align: start;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 mb-3 mb-md-5">
                        <h3>@lang('lang.general_questions')</h3>
                    </div>
                    <div id="accordion" class="accordion accordion_style1">
                        @foreach ($general_questions as $general_question)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">{{ $general_question->translation->question }}</a> </h6>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    @php
                                        echo $general_question->translation->answer
                                    @endphp
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="heading_s1 mb-3 mb-md-5">
                        <h3>@lang('lang.other_questions')</h3>
                    </div>
                    <div id="accordion2" class="accordion accordion_style1">
                        @foreach ($other_questions as $other_question)
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapseSix"
                                        aria-expanded="true" aria-controls="collapseSix">{{ $other_question->translation->question }}</a> </h6>
                            </div>
                            <div id="collapseSix" class="collapse show" aria-labelledby="headingSix"
                                data-parent="#accordion2">
                                <div class="card-body">
                                    @php
                                        echo $other_question->translation->answer
                                    @endphp
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION FAQ -->
</div>
@endsection