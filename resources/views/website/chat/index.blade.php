@extends('layouts.website_layout')

@section('additional_css')
@endsection

@section('content')
<section class="chat-page">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12 side-section" style="min-height: 600px">
                <div>
                    <div class="input-search">
                        <input type="search" class="form-control" placeholder="ضع كلمة البحث هنا ">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="chat-items">
                        @foreach ($conversations as $conversation)
                        @php
                        $other_peer = $conversation->other_peer;
                        $last_message = $conversation->latest_messages->first();
                        $last_message_created_at = explode(' ', $last_message->created_at);
                        @endphp
                        <a href="{{ url("chat/$conversation->id") }}">
                            <div class="chat-single" data-id="{{ $other_peer->id }}">
                                <div class="image">
                                    <img src="{{ url("{$other_peer->image}") }}" alt="img">
                                </div>
                                <div class="chat-info">
                                    <h6>{{ $other_peer->name }}</h6>
                                    <p>{{ $last_message->message }}</p>
                                    <div class="details">
                                        <span><i
                                                class="far fa-calendar-alt"></i>{{ $last_message_created_at[0] }}</span>
                                        <span><i class="fas fa-clock"></i>{{ $last_message_created_at[1] }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        <div class="text-center">
                            <button class="btn">اعرض المزيد<i class="fas fa-chevron-down"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('additional_scripts')
{{-- <script>
    $('.chat-action').hide();
</script> --}}
{{-- <script>
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
</script> --}}
{{-- <script>
    ///////////////////////////////////////////////// loading chat messages:
$('.chat-single').on('click', function(){
    var other_peer_id = $(this).data('id');
    $.ajax({
        url: "{{ url(app()->getLocale() . '/chat') }}/" + other_peer_id + "/load",
type: 'GET',
success: function(data) {
console.log("success");
console.log(data);
$('input[name ="peer_id"]').val(other_peer_id);
$('#chat_div').html(data);
$('.chat-action').show();
},
error: function(data) {
console.log("error");
console.log(data);
}
})
});
</script> --}}
@endsection