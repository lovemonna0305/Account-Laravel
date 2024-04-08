@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{ translate('Add New Orders') }}</h5>
</div>
<div class="">
    <!-- Error Meassages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form form-horizontal mar-top" action="{{route('orders.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row gutters-5">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Product Select')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3">
                            <div class="col-12">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select category') }}" name="category_id" required>
                                            <option value="">{{ translate('Select category') }}</option>
                                            @foreach ($category as $key => $category_item)
                                                <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select product') }}" name="product_id" required>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                    <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" 
                                        type="button" data-type="minus" data-field="quantity" disabled="">
                                        <i class="las la-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="" min="" max="10" lang="en">
                                    <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="plus" data-field="quantity">
                                        <i class="las la-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Customer Select')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select customer') }}" name="customer" required>
                                            <option value="">{{ translate('Select customer') }}</option>
                                            @foreach (\App\Models\User::where('user_type', 'customer')->get() as $key => $customer_item)
                                                <option value="{{ $customer_item->id }}">{{ $customer_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Seller Select')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select seller') }}" name="seller" required>
                                            <option value="">{{ translate('Select seller') }}</option>
                                            @foreach (\App\Models\User::where('user_type', 'seller')->get() as $key => $seller_item)
                                                <option value="{{ $seller_item->id }}">{{ $seller_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Information')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3">
                            <!-- payment method -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Payment info')}}</label>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your payment method') }}" name="payment_method" required>
                                            <option value="">{{ translate('Select your payment method') }}</option>
                                            <option value="paypal">paypal</option>
                                            <option value="stripe">stripe</option>
                                            <option value="mercadopago">mercadopago</option>
                                            <option value="sslcommerz">sslcommerz</option>
                                            <option value="instamojo">instamojo</option>
                                            <option value="razorpay">razorpay</option>
                                            <option value="paystack">paystack</option>
                                            <option value="voguepay">voguepay</option>
                                            <option value="payhere">payhere</option>
                                            <option value="ngenius">ngenius</option>
                                            <option value="iyzico">iyzico</option>
                                            <option value="nagad">nagad</option>
                                            <option value="bkash">bkash</option>
                                            <option value="aamarpay">aamarpay</option>
                                            <option value="authorizenet">authorizenet</option>
                                            <option value="payku">payku</option>
                                            <option value="flutterwave">flutterwave</option>
                                            <option value="payfast">payfast</option>
                                            <option value="paytm">paytm</option>
                                            <option value="myfatoorah">myfatoorah</option>
                                            <option value="Khalti">Khalti</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            <!-- payment status -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Payment status')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your payment status') }}" name="payment_status" required>
                                        <option value="">{{ translate('Select your payment status') }}</option>
                                        <option value="pending">
                                            Pending
                                        </option>
                                        <option value="confirmed">
                                            Confirmed
                                        </option>
                                        <option value="picked_up">
                                            Picked Up
                                        </option>
                                        <option value="on_the_way">
                                            On The Way
                                        </option>
                                        <option value="delivered">
                                            Delivered
                                        </option>
                                        <option value="cancelled">
                                            Cancel
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="Third group">
                    <button type="submit" name="button" value="unpublish" class="btn btn-primary action-btn">{{ translate('Cancel') }}</button>
                </div>
                <div class="btn-group" role="group" aria-label="Second group">
                    <button type="submit" name="button" value="publish" class="btn btn-success action-btn">{{ translate('Save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<!-- Address -->
    <script type="text/javascript">
        function add_new_address(){
            $('#new-address-modal').modal('show');
        }

        function edit_address(address) {
            var url = '{{ route("addresses.edit", ":id") }}';
            url = url.replace(':id', address);
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat     = -33.8688;
                        var long    = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                            lat     = parseFloat(response.data.address_data.latitude);
                            long    = parseFloat(response.data.address_data.longitude);
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }
        
        $(document).on('change', '[name=country_id]', function() {
            var country_id = $(this).val();
            get_states(country_id);
        });

        $(document).on('change', '[name=state_id]', function() {
            var state_id = $(this).val();
            get_city(state_id);
        });
        
        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-state')}}",
                type: 'POST',
                data: {
                    country_id  : country_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="state_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    </script>
<!-- Product -->
    <script type="text/javascript">
        $(document).on('change', '[name=category_id]', function() {
            var category_id = $(this).val();
            get_product(category_id);
        });
        function get_product(category_id) {
            $('[name="product"]').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-product')}}",
                type: 'POST',
                data: {
                    category_id: category_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="product_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        $(document).on('change', '[name=product_id]', function(){
            var product_id = $(this).val();
            var qty = $(this)[0].selectedOptions[0].dataset.qty;
            add_qty(product_id, qty);
        });
        function add_qty(product_id, qty) {
            var html = "";


        }
    </script>
@endsection