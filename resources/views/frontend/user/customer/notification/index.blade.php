@extends('frontend.layouts.user_panel')

@section('panel_content')

<div class="card rounded-0 shadow-none border">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header border-bottom-0 row gutters-5">
            <div class="col">
                <h5 class="mb-0 fs-20 fw-700 text-dark">{{translate('Notifications')}}</h5>
            </div>
        </div>
        <div class="card-body">
            <!-- Notifications -->
            <ul class="list-group list-group-flush">
                @forelse($notifications as $notification)
                    @if($notification->type == 'App\Notifications\OrderNotification')
                        <li class="list-group-item d-flex justify-content-between align-items- py-3 px-0">
                            <div class="media text-inherit">
                                <div class="media-body">
                                    <p class="mb-1 text-truncate-2">
                                        {{translate('Your Order: ')}}
                                        <a href="{{route('purchase_history.details', encrypt($notification->data['order_id']))}}">
                                            {{$notification->data['order_code']}}
                                        </a>
                                        {{translate(' has been '. ucfirst(str_replace('_', ' ', $notification->data['status'])))}}
                                    </p>
                                    <small class="text-muted">
                                        {{ date("F j Y, g:i a", strtotime($notification->created_at)) }}
                                    </small>
                                </div>
                            </div>
                        </li>
                    @endif

                @empty
                    <li class="list-group-item">
                        <div class="py-4 text-center fs-16">{{ translate('No notification found') }}</div>
                    </li>
                @endforelse
            </ul>
            <!-- Pagination -->
            <div class="aiz-pagination mt-3">
                {{ $notifications->links() }}
            </div>
        </div>
    </form>
</div>

@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')

    <!-- Rrder details modal -->
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <!-- Payment modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection
