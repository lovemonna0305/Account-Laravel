@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
        <div class="h6 fw-700">
            <span>{{ translate('Conversations With ')}}</span>
            @if ($conversation->sender_id == Auth::user()->id && $conversation->receiver->shop != null)
                <a href="{{ route('shop.visit', $conversation->receiver->shop->slug) }}" class="">{{ $conversation->receiver->shop->name }}</a>
            @endif
        </div>
    </div>
    <div class="card rounded-0 shadow-none border">
        <div class="card-header bg-light">
            <div>
                <!-- Conversation title -->
                <h5 class="card-title fs-14 fw-700 mb-1">{{ $conversation->title }}</h5>
                <!-- Conversation Woth -->
                <p class="mb-0 fs-14 text-secondary fw-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-2">
                        <g id="Group_24976" data-name="Group 24976" transform="translate(1053.151 256.688)">
                            <path id="Path_3012" data-name="Path 3012" d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z" transform="translate(-1178 -341)" fill="#b5b5bf"/>
                            <path id="Path_3013" data-name="Path 3013" d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1" transform="translate(-1182 -337)" fill="#b5b5bf"/>
                            <path id="Path_3014" data-name="Path 3014" d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1" transform="translate(-1181 -343.5)" fill="#b5b5bf"/>
                            <path id="Path_3015" data-name="Path 3015" d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1" transform="translate(-1181 -346.5)" fill="#b5b5bf"/>
                        </g>
                    </svg>
                    {{ translate('Between you and') }}
                    @if ($conversation->sender_id == Auth::user()->id)
                        {{ $conversation->receiver->shop ? $conversation->receiver->shop->name : $conversation->receiver->name }}
                    @else
                        {{ $conversation->sender->name }}
                    @endif
                </p>
            </div>
        </div>

        <div class="card-body">
            <!-- Conversations -->
            <ul class="list-group list-group-flush">
                @foreach($conversation->messages as $message)
                    <li class="list-group-item px-0">
                        <div class="media mb-2">
                            @if (Auth::user()->id != $message->user_id && $message->user->shop != null)
                                <a href="{{ route('shop.visit', $message->user->shop->slug) }}" class="">
                                    <img  class="avatar avatar-sm mr-3" src="{{ uploaded_asset($message->user->shop->logo) }}" 
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                </a>
                            @else
                                <img class="avatar avatar-sm mr-3" @if($message->user != null) src="{{ uploaded_asset($message->user->avatar_original) }}" @endif 
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            @endif
                            <div class="media-body">
                                <h6 class="mb-0 fw-600 mb-2">
                                    @if (Auth::user()->id != $message->user_id && $message->user->shop != null)
                                        <a href="{{ route('shop.visit', $message->user->shop->slug) }}" class="text-reset hov-text-primary">{{ $message->user->shop->name }}</a>
                                    @else
                                        {{ $message->user ? $message->user->name : '' }}
                                    @endif
                                </h6>
                                <p class="fs-12 text-secondary">
                                    {{ date('d.m.Y h:i:m', strtotime($message->created_at)) }}
                                </p>
                            </div>
                        </div>
                        <p class="fs-14 fw-400">
                            {{ $message->message }}
                        </p>
                    </li>
                @endforeach
            </ul>
            
            <!-- Send message -->
            <form class="pt-4" action="{{ route('messages.store') }}" method="POST">
                @csrf
                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                <div class="form-group">
                    <textarea class="form-control rounded-0" rows="4" name="message" placeholder="{{ translate('Type your reply') }}" required></textarea>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary rounded-0 w-150px">{{ translate('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
    function refresh_messages(){
        $.post('{{ route('conversations.refresh') }}', {_token:'{{ @csrf_token() }}', id:'{{ encrypt($conversation->id) }}'}, function(data){
            $('#messages').html(data);
        })
    }

    refresh_messages(); // This will run on page load
    setInterval(function(){
        refresh_messages() // this will run after every 4 seconds
    }, 4000);
    </script>
@endsection
