@extends('layouts.website_layout')

@section('additional_css')
@endsection

@section('content')
<section class="chat-page">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 side-section" style="min-height: 600px">
                <div>
                    <div class="chat-items">
                        <div class="row">
                            @php ($user = $user_offer->user)
                            <div class="col-md-4"><img src="{{ url("$user->image") }}" alt="@lang('lang.user_image')">
                            </div>
                            <div class="col-md-8">{{ $user->name }}</div>
                        </div>
                        <div class="row">
                            @php ($product = $user_offer->product)
                            <div class="col-md-4"><img src="{{ url("{$product->images[0]->image_url}") }}"
                                    alt="@lang('lang.user_image')"></div>
                            <div class="col-md-8">{{ $product->translation->name }}</div>
                        </div>
                        <div class="row">
                            @lang('lang.quantity'): {{ $user_offer->quantity }}
                        </div>
                        <div class="row">
                            @lang('lang.requested_price'): {{ $user_offer->requested_price }}
                        </div>
                        <div class="row">
                            @lang('lang.date'): {{ $user_offer->updated_at }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="chat-body" id="chat-body">
                    <div class="chat-section" id="chat_div">

                    </div>
                </div>
                <div class="chat-action">
                    <form class="chat-action-inner" id="send_message_form">
                        <input type="text" class="form-control" name="txt">
                        <input type="file" class="file-btn upload" name="file">
                        <i class="fas fa-file"></i>
                        <input type="file" class="image-btn upload" name="image">
                        <input type="hidden" name="peer_id" value="14">
                        <i class="fas fa-images"></i>
                        <button class="send-btn">@lang('lang.send')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
<script>
    $('.chat-action').hide();
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    ///////////////////////////////////////////////// sending messages:
    $('#send_message_form').submit(function(e){
        e.preventDefault();

        var fd = new FormData(this);
        fd.append("_token", "{{ csrf_token() }}");

        $.ajax({
            url: "{{ url(app()->getLocale() . '/chat/send') }}",
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
                console.log("success");
                console.log(data);
                $('#chat_div').append(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    });
</script>
<script>

///////////////////////////////////////////////// loading chat messages:
$.ajax({
    url: "{{ url(app()->getLocale() . '/chat') }}/{{ $user->id }}/load",
    type: 'GET',
    success: function(data) {
        console.log("success");
        console.log(data);
        $('input[name ="peer_id"]').val({{ $user->id }});
        $('#chat_div').html(data);
        $('.chat-action').show();
    },
    error: function(data) {
        console.log("error");
        console.log(data);
    }
})
</script>


@endsection