@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
      <div class="row align-items-center">
          <div class="col-md-6">
              <h5 class="fs-20 fw-700 text-dark">{{ translate('Conversations')}}</h5>
              <p class="fs-14 fw-400 text-secondary">{{ translate('Select a conversation to view all messages')}}</p>
          </div>
      </div>
    </div>

    <!-- Conversations -->
    @if (count($conversations) > 0)
        <div class="p-0">
            <ul class="list-group list-group-flush p-0">
                @foreach ($conversations as $key => $conversation)
                    @if ($conversation->receiver != null && $conversation->sender != null)
                        <li class="list-group-item p-4 has-transition hov-bg-light border mb-3">
                            <div class="row gutters-10">
                                <!-- Receiver/Shop Image -->
                                <div class="col-auto">
                                    <div class="media">
                                        <span class="avatar avatar-sm flex-shrink-0 border">
                                            @if (Auth::user()->id == $conversation->sender_id)
                                                @if ($conversation->receiver->shop != null)
                                                    <a href="{{ route('shop.visit', $conversation->receiver->shop->slug) }}" class="">
                                                        <img src="{{ uploaded_asset($conversation->receiver->shop->logo) }}" 
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                                    </a>
                                                @else
                                                    <img @if ($conversation->receiver->avatar_original == null) src="{{ static_asset('assets/img/avatar-place.png') }}" 
                                                        @else src="{{ uploaded_asset($conversation->receiver->avatar_original) }}" @endif 
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                                @endif
                                            @else
                                                <img @if ($conversation->sender->avatar_original == null) src="{{ static_asset('assets/img/avatar-place.png') }}" @else src="{{ uploaded_asset($conversation->sender->avatar_original) }}" @endif class="rounded-circle" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!-- Receiver/Shop Name & Time -->
                                <div class="col-auto col-lg-3">
                                        @if (Auth::user()->id == $conversation->sender_id)
                                            <h6 class="text-dark mb-2">
                                                @if ($conversation->receiver->shop != null)
                                                    <a href="{{ route('shop.visit', $conversation->receiver->shop->slug) }}" class="text-reset hov-text-primary fw-700 fs-14">{{ $conversation->receiver->shop->name }}</a>
                                                @else
                                                    <span class="text-dark fw-700 fs-14 mb-2">{{ $conversation->receiver->name }}</span>
                                                @endif
                                            </h6>
                                        @else
                                            <h6 class="text-dark fw-700 fs-14 mb-2">{{ $conversation->sender->name }}</h6>
                                        @endif
                                        <small class="text-secondary fs-12">
                                            {{ date('d.m.Y h:i:m', strtotime($conversation->messages->last()->created_at)) }}
                                        </small>
                                </div>
                                <!-- conversation -->
                                <div class="col-12 col-lg">
                                    <div class="block-body">
                                        <div class="block-body-inner pb-3">
                                            <!-- Title -->
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <h6 class="mt-0">
                                                        <a href="{{ route('conversations.show', encrypt($conversation->id)) }}" class="text-reset hov-text-primary fs-14 fw-700">
                                                            {{ $conversation->title }}
                                                        </a>
                                                        @if ((Auth::user()->id == $conversation->sender_id && $conversation->sender_viewed == 0) || (Auth::user()->id == $conversation->receiver_id && $conversation->receiver_viewed == 0))
                                                            <span class="badge badge-inline badge-danger">{{ translate('New') }}</span>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                            <!-- Last Message -->
                                            <p class="mb-0 text-secondary fs-14">
                                                {{ $conversation->messages->last()->message }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        <div class="row">
            <div class="col">
                <div class="text-center bg-white p-4 border">
                    <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                    <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                </div>
            </div>
        </div>
    @endif
    <!-- Pagination -->
    <div class="aiz-pagination">
      	{{ $conversations->links() }}
    </div>
@endsection
