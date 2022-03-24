@extends('layouts.website_layout')

@section('additional_css')
<link rel="stylesheet" href="{{ URL::TO('/') }}/public/assets/css/chat.css">
@endsection

@section('content')
<section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i>
            {{ $conversation->other_peer->name }}
        </div>
    </header>

    <main class="msger-chat" id="msger-chat">
    </main>

    <form class="msger-inputarea" id="myForm" data-peer_id="{{ $conversation->other_peer->id }}"
        data-token="{{ csrf_token() }}" data-url="{{ url(app()->getLocale() . '/chat/send') }}">
        <input type="text" class="msger-input" placeholder="Enter your message...">
        <input type="file" accept="image/*" name="image" id="input-image" onchange="uploadImage(this);"
            style="display: none;">
        <label for="input-image" class="img-btn">Upload Image</label>
        <input type="file" accept="file/*" name="file" id="input-file" onchange="uploadFile(this);"
            style="display: none;">
        <label for="input-file" class="file-btn">File</label>
        <button type="submit" class="msger-send-btn">Send</button>
    </form>
</section>
@endsection

@section('additional_scripts')
<script src="{{ URL::TO('/') }}/public/assets/js/chat.js"></script>
<script>
    @foreach ($conversation->latest_messages->splice(0, 10)->reverse() as $message)
        @php
            $sender = $message->sender;
            $message_carbon = \Illuminate\Support\Carbon::parse($message->created_at);
        @endphp
        
        var name = "{{ $sender->name }}";
        var img = '{{ url("$sender->image") }}';
        var side = "{{ $sender->id == Auth::user()->id?'right':'left' }}";
        @if(date("Y-m-d") != $message_carbon->format("Y-m-d"))
            var date = '{{ $message_carbon->format("Y-m-d h:i") }}';
        @else
            var date = '{{ $message_carbon->format("h:i") }}';
        @endif
        
        @if($message->file_type == 1)
            appendOldFile(name, img, side, '{{ url("$message->file_url") }}', date);
        @elseif($message->file_type == 2)
            appendOldImage(name, img, side, '{{ url("$message->file_url") }}', date);
        @else
            appendOldMessage(name, img, side, "{{ $message->message }}", date);
        @endif
    @endforeach
</script>
@endsection