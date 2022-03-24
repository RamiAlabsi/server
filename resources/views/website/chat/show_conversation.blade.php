@foreach ($messages as $message)
    @if ($message->file_type == null)
    {{-- normal message --}}
    <div class="{{ $is_peer1 == $message->peer1_to_peer2?"reseve":"send" }}-message block-message">
        <div class="info-message">
            <div class="message">
                <p>{{ $message->message }}</p>
            </div>
            <div class="details">
                <span><i class="far fa-calendar-alt"></i>{{ explode(' ', $message->created_at)[0] }}</span>
                <span><i class="fas fa-clock"></i>{{ explode(' ', $message->created_at)[1] }}</span>
            </div>
        </div>
        @if ($is_peer1 != $message->peer1_to_peer2)
        <div class="image"><img src="{{ url("$other_peer_image") }}" alt="img"></div>
        @endif
    </div>
    @elseif($message->file_type == 2)
    {{-- image --}}
    <div class="{{ $is_peer1 == $message->peer1_to_peer2?"reseve":"send" }}-message block-message">
        <div class="info-message">
            <div class="message">
                <img src="{{ url("$message->file_url") }}" alt="" class="img-message">
                <p>{{ $message->message }}</p>
            </div>
            <div class="details">
                <span><i class="far fa-calendar-alt"></i>{{ explode(' ', $message->created_at)[0] }}</span>
                <span><i class="fas fa-clock"></i>{{ explode(' ', $message->created_at)[1] }}</span>
            </div>
        </div>
        @if ($is_peer1 != $message->peer1_to_peer2)
        <div class="image"><img src="{{ url("$other_peer_image") }}" alt="img"></div>
        @endif
    </div>
    @elseif($message->file_type == 1)
    {{-- file --}}
    <div class="{{ $is_peer1 == $message->peer1_to_peer2?"reseve":"send" }}-message block-message">
        <div class="info-message">
            <div class="message">
                <div class="uploaded-file">
                    <div class="icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                            </path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div class="meta"><span>{{ $message->file_name }}</span>
                        {{-- <span>228 Kb</span> --}}
                    </div>
                    <div class="action">
                        <a href="{{ url("$message->file_url") }}"
                            download="{{ $message->file_name }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-download-cloud">
                                <polyline points="8 17 12 21 16 17"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                <p>{{ $message->message }}</p>
            </div>
            <div class="details">
                <span><i class="far fa-calendar-alt"></i>{{ explode(' ', $message->created_at)[0] }}</span>
                <span><i class="fas fa-clock"></i>{{ explode(' ', $message->created_at)[1] }}</span>
            </div>
        </div>
        @if ($is_peer1 != $message->peer1_to_peer2)
        <div class="image"><img src="{{ url("$other_peer_image") }}" alt="img"></div>
        @endif
    </div>
    @endif
@endforeach