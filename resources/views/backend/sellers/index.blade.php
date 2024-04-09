@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All Sellers') }}</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('add_new_sellers.index') }}" class="btn btn-circle btn-info">
                    <span>{{ translate('Add New Sellers') }}</span>
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="card">
        <form class="" id="sort_sellers" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('Sellers') }}</h5>
                </div>

                @can('delete_seller')
                    <div class="dropdown mb-2 mb-md-0">
                        <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                            {{ translate('Bulk Action') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"
                                onclick="bulk_delete()">{{ translate('Delete selection') }}</a>
                        </div>
                    </div>
                @endcan

                <div class="col-md-3 ml-auto">
                    <select class="form-control aiz-selectpicker" name="approved_status" id="approved_status"
                        onchange="sort_sellers()">
                        <option value="">{{ translate('Filter by Approval') }}</option>
                        <option value="1"
                            @isset($approved) @if ($approved == '1') selected @endif @endisset>
                            {{ translate('Approved') }}</option>
                        <option value="0"
                            @isset($approved) @if ($approved == '0') selected @endif @endisset>
                            {{ translate('Non-Approved') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ translate('Type name or email & Enter') }}">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>

                            <th>
                                @if (auth()->user()->can('delete_seller'))
                                    <div class="form-group">
                                        <div class="aiz-checkbox-inline">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" class="check-all">
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    #
                                @endif
                            </th>
                            <th>{{ translate('Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Phone') }}</th>
                            <th data-breakpoints="lg">{{ translate('Email Address') }}</th>
                            <th data-breakpoints="lg">{{ translate('Verification Info') }}</th>
                            <th data-breakpoints="lg">{{ translate('Approval') }}</th>
                            <th data-breakpoints="lg">{{ translate('Num. of Products') }}</th>
                            <th data-breakpoints="lg">{{ translate('Due to seller') }}</th>
                            <th width="15%">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $key => $shop)
                            <tr>
                                <td>
                                    @if (auth()->user()->can('delete_seller'))
                                        <div class="form-group">
                                            <div class="aiz-checkbox-inline">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" class="check-one" name="id[]"
                                                        value="{{ $shop->id }}">
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        {{ $key + 1 + ($shops->currentPage() - 1) * $shops->perPage() }}
                                    @endif
                                </td>
                                <td>
                                    @if ($shop->user->banned == 1)
                                        <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                    @endif {{ $shop->name }}
                                </td>
                                <td>{{ $shop->user->phone }}</td>
                                <td>{{ $shop->user->email }}</td>
                                <td>
                                    @if ($shop->verification_status != 1 && $shop->verification_info != null)
                                        <a href="{{ route('sellers.show_verification_request', $shop->id) }}">
                                            <span class="badge badge-inline badge-info">{{ translate('Show') }}</span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input @can('approve_seller') onchange="update_approved(this)" @endcan
                                            value="{{ $shop->id }}" type="checkbox" <?php if ($shop->verification_status == 1) {
                                                echo 'checked';
                                            } ?>
                                            @cannot('approve_seller') disabled @endcan
                                >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>{{ $shop->user->products->count() }}</td>
                        <td>
                            @if ($shop->admin_to_pay >= 0)
                                {{ single_price($shop->admin_to_pay) }}
                            @else
                                {{ single_price(abs($shop->admin_to_pay)) }} ({{ translate('Due to Admin') }})
                            @endif
                        </td>
                        <td class="text-left">
                            @can('edit_as_customer')
                                <a href="{{ route('sellers.edit', encrypt($shop->id)) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                            @endcan
                            {{-- @can('ban_customer')
                                @if ($user->banned != 1)
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('{{ route('customers.ban', ) }}');" title="{{ translate('Ban this Customer') }}">
                                        <i class="las la-user-slash"></i>
                                    </a>
                                    @else
                                    <a href="#" class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="confirm_unban('{{ route('customers.ban', ) }}');" title="{{ translate('Unban this Customer') }}">
                                        <i class="las la-user-check"></i>
                                    </a>
                                @endif
                            @endcan --}}

                            @can('ban_seller')
                            @if ($shop->user->banned != 1)
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('{{ route('sellers.ban', $shop->id) }}');" title="{{ translate('Ban this seller') }}">
                                    <i class="las la-user-slash"></i>
                                </a>
                            @else
                                <a href="#" class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="confirm_unban('{{ route('sellers.ban', $shop->id) }}');" title="{{ translate('Unban this seller') }}">
                                    <i class="las la-user-check"></i>
                                </a>
                            @endif
                            @endcan

                            @can('delete_customer')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('sellers.destroy', $shop->id) }} title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            @endcan
                                <a type="button" class="btn btn-sm btn-circle btn-soft-primary btn-icon " data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="las la-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                    @can('view_seller_profile')
                                        <a href="#" onclick="show_seller_profile('{{ $shop->id }}');"  class="dropdown-item">
                                            {{ translate('Profile') }}
                                        </a>
                                    @endcan
                                    @can('login_as_seller')
                                        <a href="{{ route('sellers.login', encrypt($shop->id)) }}" class="dropdown-item">
                                            {{ translate('Log in as this Seller') }}
                                        </a>
                                    @endcan
                                    {{-- @can('pay_to_seller')
                                        <a href="#" onclick="show_seller_payment_modal('{{ $shop->id }}');" class="dropdown-item">
                                            {{ translate('Go to Payment') }}
                                        </a>
                                    @endcan --}}
                                    {{-- @can('seller_payment_history')
                                        <a href="{{ route('sellers.payment_history', encrypt($shop->user_id)) }}" class="dropdown-item">
                                            {{ translate('Payment History') }}
                                        </a>
                                    @endcan --}}
                                    {{-- @can('edit_seller')
                                        <a href="{{ route('sellers.edit', encrypt($shop->id)) }}" class="dropdown-item">
                                            {{ translate('Edit') }}
                                        </a>
                                    @endcan --}}
                                    {{-- @can('ban_seller')
                                        @if ($shop->user->banned != 1)
                                            <a href="#" onclick="confirm_ban('{{ route('sellers.ban', $shop->id) }}');" class="dropdown-item">
                                            {{ translate('Ban this seller') }}
                                            <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="#" onclick="confirm_unban('{{ route('sellers.ban', $shop->id) }}');" class="dropdown-item">
                                            {{ translate('Unban this seller') }}
                                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        @endcan
                                        @can('delete_seller')
                                        <a href="#" class="dropdown-item confirm-delete" data-href="{{ route('sellers.destroy', $shop->id) }}" class="">
                                            {{ translate('Delete') }}
                                        </a>
                                    @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $shops->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>
@endsection

@section('modal')
<!-- Delete Modal -->
@include('modals.delete_modal')

<!-- Seller Profile Modal -->
<div class="modal fade" id="profile_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="profile-modal-content">

        </div>
    </div>
</div>

<!-- Seller Payment Modal -->
<div class="modal fade" id="payment_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="payment-modal-content">

        </div>
    </div>
</div>

<!-- Ban Seller Modal -->
<div class="modal fade" id="confirm-ban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <p>{{ translate('Do you really want to ban this seller?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Cancel') }}</button>
                <a class="btn btn-primary" id="confirmation">{{ translate('Proceed!') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Unban Seller Modal -->
<div class="modal fade" id="confirm-unban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <p>{{ translate('Do you really want to unban this seller?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Cancel') }}</button>
                <a class="btn btn-primary" id="confirmationunban">{{ translate('Proceed!') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).on("change", ".check-all", function() {
        if (this.checked) {
            // Iterate each checkbox
            $('.check-one:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.check-one:checkbox').each(function() {
                this.checked = false;
            });
        }

    });

    function show_seller_payment_modal(id) {
        $.post('{{ route('sellers.payment_modal') }}', {
            _token: '{{ @csrf_token() }}',
            id: id
        }, function(data) {
            $('#payment_modal #payment-modal-content').html(data);
            $('#payment_modal').modal('show', {
                backdrop: 'static'
            });
            $('.demo-select2-placeholder').select2();
        });
    }

    function show_seller_profile(id) {
        $.post('{{ route('sellers.profile_modal') }}', {
            _token: '{{ @csrf_token() }}',
            id: id
        }, function(data) {
            $('#profile_modal #profile-modal-content').html(data);
            $('#profile_modal').modal('show', {
                backdrop: 'static'
            });
        });
    }

    function update_approved(el) {
        if (el.checked) {
            var status = 1;
        } else {
            var status = 0;
        }
        $.post('{{ route('sellers.approved') }}', {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function(data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Approved sellers updated successfully') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }

    function sort_sellers(el) {
        $('#sort_sellers').submit();
    }

    function confirm_ban(url) {
        $('#confirm-ban').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('confirmation').setAttribute('href', url);
    }

    function confirm_unban(url) {
        $('#confirm-unban').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('confirmationunban').setAttribute('href', url);
    }

    function bulk_delete() {
        var data = new FormData($('#sort_sellers')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('bulk-seller-delete') }}",
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
</script>
@endsection
