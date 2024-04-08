@extends('frontend.layouts.app')

@section('content')

    <!-- Steps -->
    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row gutters-5 sm-gutters-10">
                        <div class="col done">
                            <div class="text-center border border-bottom-6px p-2 text-success">
                                <i class="la-3x mb-2 las la-shopping-cart"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="text-center border border-bottom-6px p-2 text-success">
                                <i class="la-3x mb-2 las la-map"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('2. Shipping info') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col active">
                            <div class="text-center border border-bottom-6px p-2 text-primary">
                                <i class="la-3x mb-2 las la-truck cart-animate" style="margin-left: -100px; transition: 2s;"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('3. Delivery info') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border border-bottom-6px p-2">
                                <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border border-bottom-6px p-2">
                                <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Delivery Info -->
    <section class="py-4 gry-bg">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-10 mx-auto">
                    <div class="border bg-white p-4 mb-4">
                        <form class="form-default" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                            @csrf
                            @php
                                $admin_products = array();
                                $seller_products = array();
                                $admin_product_variation = array();
                                $seller_product_variation = array();
                                foreach ($carts as $key => $cartItem){
                                    $product = \App\Models\Product::find($cartItem['product_id']);

                                    if($product->added_by == 'admin'){
                                        array_push($admin_products, $cartItem['product_id']);
                                        $admin_product_variation[] = $cartItem['variation'];
                                    }
                                    else{
                                        $product_ids = array();
                                        if(isset($seller_products[$product->user_id])){
                                            $product_ids = $seller_products[$product->user_id];
                                        }
                                        array_push($product_ids, $cartItem['product_id']);
                                        $seller_products[$product->user_id] = $product_ids;
                                        $seller_product_variation[] = $cartItem['variation'];
                                    }
                                }
                                
                                $pickup_point_list = array();
                                if (get_setting('pickup_point') == 1) {
                                    $pickup_point_list = \App\Models\PickupPoint::where('pick_up_status',1)->get();
                                }
                            @endphp

                            <!-- Inhouse Products -->
                            @if (!empty($admin_products))
                            <div class="card mb-5 border-0 rounded-0 shadow-none">
                                <div class="card-header py-3 px-0 border-bottom-0">
                                    <h5 class="fs-16 fw-700 text-dark mb-0">{{ get_setting('site_name') }} {{ translate('Inhouse Products') }}</h5>
                                </div>
                                <div class="card-body p-0">
                                    <!-- Product List -->
                                    <ul class="list-group list-group-flush border p-3 mb-3">
                                        @php
                                            $physical = false;
                                        @endphp
                                        @foreach ($admin_products as $key => $cartItem)
                                            @php
                                                $product = \App\Models\Product::find($cartItem);
                                                if ($product->digital == 0) {
                                                    $physical = true;
                                                }
                                            @endphp
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-2 mr-md-3">
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            class="img-fit size-60px"
                                                            alt="{{  $product->getTranslation('name')  }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                    </span>
                                                    <span class="fs-14 fw-400 text-dark">
                                                        {{ $product->getTranslation('name') }}
                                                        <br>
                                                        @if ($admin_product_variation[$key] != '')
                                                            <span class="fs-12 text-secondary">{{ translate('Variation') }}: {{ $admin_product_variation[$key] }}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- Choose Delivery Type -->
                                    @if ($physical)
                                        <div class="row pt-3">
                                            <div class="col-md-6">
                                                <h6 class="fs-14 fw-700 mt-3">{{ translate('Choose Delivery Type') }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row gutters-5">
                                                    <!-- Home Delivery -->
                                                    @if (get_setting('shipping_type') != 'carrier_wise_shipping')
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="home_delivery"
                                                                onchange="show_pickup_point(this, 'admin')"
                                                                data-target=".pickup_point_id_admin"
                                                                checked
                                                            >
                                                            <span class="d-flex aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <!-- Carrier -->
                                                    @else
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="carrier"
                                                                onchange="show_pickup_point(this, 'admin')"
                                                                data-target=".pickup_point_id_admin"
                                                                checked
                                                            >
                                                            <span class="d-flex aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Carrier') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                    <!-- Local Pickup -->
                                                    @if ($pickup_point_list)
                                                    <div class="col-6">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="shipping_type_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="pickup_point"
                                                                onchange="show_pickup_point(this, 'admin')"
                                                                data-target=".pickup_point_id_admin"
                                                            >
                                                            <span class="d-flex aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                </div>

                                                <!-- Pickup Point List -->
                                                @if ($pickup_point_list)
                                                    <div class="mt-3 pickup_point_id_admin d-none">
                                                        <select
                                                            class="form-control aiz-selectpicker rounded-0"
                                                            name="pickup_point_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                            data-live-search="true"
                                                        >
                                                                <option>{{ translate('Select your nearest pickup point')}}</option>
                                                            @foreach ($pickup_point_list as $pick_up_point)
                                                                <option
                                                                    value="{{ $pick_up_point->id }}"
                                                                    data-content="<span class='d-block'>
                                                                                    <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                                    <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                                </span>"
                                                                >
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Carrier Wise Shipping -->
                                        @if (get_setting('shipping_type') == 'carrier_wise_shipping')
                                            <div class="row pt-3 carrier_id_admin">
                                                @foreach($carrier_list as $carrier_key => $carrier)
                                                    <div class="col-md-12 mb-2">
                                                        <label class="aiz-megabox d-block bg-white mb-0">
                                                            <input
                                                                type="radio"
                                                                name="carrier_id_{{ \App\Models\User::where('user_type', 'admin')->first()->id }}"
                                                                value="{{ $carrier->id }}"
                                                                @if($carrier_key == 0) checked @endif
                                                            >
                                                            <span class="d-flex p-3 aiz-megabox-elem rounded-0">
                                                                <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                <span class="flex-grow-1 pl-3 fw-600">
                                                                    <img src="{{ uploaded_asset($carrier->logo)}}" alt="Image" class="w-50px img-fit">
                                                                </span>
                                                                <span class="flex-grow-1 pl-3 fw-700">{{ $carrier->name }}</span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{ translate('Transit in').' '.$carrier->transit_time }}</span>
                                                                <span class="flex-grow-1 pl-3 fw-600">{{ single_price(carrier_base_price($carts, $carrier->id, \App\Models\User::where('user_type', 'admin')->first()->id)) }}</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Seller Products -->
                            @if (!empty($seller_products))
                                @foreach ($seller_products as $key => $seller_product)
                                    <div class="card mb-5 border-0 rounded-0 shadow-none">
                                        <div class="card-header py-3 px-0 border-bottom-0">
                                            <h5 class="fs-16 fw-700 text-dark mb-0">{{ \App\Models\Shop::where('user_id', $key)->first()->name }} {{ translate('Products') }}</h5>
                                        </div>
                                        <div class="card-body p-0">
                                            <!-- Product List -->
                                            <ul class="list-group list-group-flush border p-3 mb-3">
                                                @php
                                                    $physical = false;
                                                @endphp
                                                @foreach ($seller_product as $key2 => $cartItem)
                                                    @php
                                                        $product = \App\Models\Product::find($cartItem);
                                                        if ($product->digital == 0) {
                                                            $physical = true;
                                                        }
                                                    @endphp
                                                    <li class="list-group-item">
                                                        <div class="d-flex align-items-center">
                                                            <span class="mr-2 mr-md-3">
                                                                <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                    class="img-fit size-60px"
                                                                    alt="{{  $product->getTranslation('name')  }}"
                                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                            </span>
                                                            <span class="fs-14 fw-400 text-dark">
                                                                {{ $product->getTranslation('name') }}
                                                                <br>
                                                                @if ($seller_product_variation[$key2] != '')
                                                                    <span class="fs-12 text-secondary">{{ translate('Variation') }}: {{ $seller_product_variation[$key2] }}</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <!-- Choose Delivery Type -->
                                            @if ($physical)
                                                <div class="row pt-3">
                                                    <div class="col-md-6">
                                                        <h6 class="fs-14 fw-700 mt-3">{{ translate('Choose Delivery Type') }}</h6>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row gutters-5">
                                                            <!-- Home Delivery -->
                                                            @if (get_setting('shipping_type') != 'carrier_wise_shipping')
                                                            <div class="col-6">
                                                                <label class="aiz-megabox d-block bg-white mb-0">
                                                                    <input
                                                                        type="radio"
                                                                        name="shipping_type_{{ $key }}"
                                                                        value="home_delivery"
                                                                        onchange="show_pickup_point(this, {{ $key }})"
                                                                        data-target=".pickup_point_id_{{ $key }}"
                                                                        checked
                                                                    >
                                                                    <span class="d-flex p-3 aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            <!-- Carrier -->
                                                            @else
                                                            <div class="col-6">
                                                                <label class="aiz-megabox d-block bg-white mb-0">
                                                                    <input
                                                                        type="radio"
                                                                        name="shipping_type_{{ $key }}"
                                                                        value="carrier"
                                                                        onchange="show_pickup_point(this, {{ $key }})"
                                                                        data-target=".pickup_point_id_{{ $key }}"
                                                                        checked
                                                                    >
                                                                    <span class="d-flex p-3 aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">{{  translate('Carrier') }}</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                            @endif
                                                            <!-- Local Pickup -->
                                                            @if ($pickup_point_list)
                                                                <div class="col-6">
                                                                    <label class="aiz-megabox d-block bg-white mb-0">
                                                                        <input
                                                                            type="radio"
                                                                            name="shipping_type_{{ $key }}"
                                                                            value="pickup_point"
                                                                            onchange="show_pickup_point(this, {{ $key }})"
                                                                            data-target=".pickup_point_id_{{ $key }}"
                                                                        >
                                                                        <span class="d-flex p-3 aiz-megabox-elem rounded-0" style="padding: 0.75rem 1.2rem;">
                                                                            <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                            <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Pickup Point List -->
                                                        @if ($pickup_point_list)
                                                            <div class="mt-4 pickup_point_id_{{ $key }} d-none">
                                                                <select
                                                                    class="form-control aiz-selectpicker rounded-0"
                                                                    name="pickup_point_id_{{ $key }}"
                                                                    data-live-search="true"
                                                                >
                                                                    <option>{{ translate('Select your nearest pickup point')}}</option>
                                                                        @foreach ($pickup_point_list as $pick_up_point)
                                                                        <option
                                                                            value="{{ $pick_up_point->id }}"
                                                                            data-content="<span class='d-block'>
                                                                                            <span class='d-block fs-16 fw-600 mb-2'>{{ $pick_up_point->getTranslation('name') }}</span>
                                                                                            <span class='d-block opacity-50 fs-12'><i class='las la-map-marker'></i> {{ $pick_up_point->getTranslation('address') }}</span>
                                                                                            <span class='d-block opacity-50 fs-12'><i class='las la-phone'></i>{{ $pick_up_point->phone }}</span>
                                                                                        </span>"
                                                                        >
                                                                        </option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Carrier Wise Shipping -->
                                                @if (get_setting('shipping_type') == 'carrier_wise_shipping')
                                                    <div class="row pt-3 carrier_id_{{ $key }}">
                                                        @foreach($carrier_list as $carrier_key => $carrier)
                                                            <div class="col-md-12 mb-2">
                                                                <label class="aiz-megabox d-block bg-white mb-0">
                                                                    <input
                                                                        type="radio"
                                                                        name="carrier_id_{{ $key }}"
                                                                        value="{{ $carrier->id }}"
                                                                        @if($carrier_key == 0) checked @endif
                                                                    >
                                                                    <span class="d-flex p-3 aiz-megabox-elem rounded-0">
                                                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">
                                                                            <img src="{{ uploaded_asset($carrier->logo)}}" alt="Image" class="w-50px img-fit">
                                                                        </span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">{{ $carrier->name }}</span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">{{ translate('Transit in').' '.$carrier->transit_time }}</span>
                                                                        <span class="flex-grow-1 pl-3 fw-600">{{ single_price(carrier_base_price($carts, $carrier->id, $key)) }}</span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="pt-4 d-flex justify-content-between align-items-center">
                                <!-- Return to shop -->
                                <a href="{{ route('home') }}"  class="btn btn-link fs-14 fw-700 px-0">
                                    <i class="la la-arrow-left fs-16"></i>
                                    {{ translate('Return to shop')}}
                                </a>
                                <!-- Continue to Payment -->
                                <button type="submit" class="btn btn-primary fs-14 fw-700 rounded-0 px-4">{{ translate('Continue to Payment')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        function display_option(key){

        }
        function show_pickup_point(el,type) {
        	var value = $(el).val();
        	var target = $(el).data('target');

        	if(value == 'home_delivery' || value == 'carrier'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
                $('.carrier_id_'+type).removeClass('d-none');
        	}else{
        		$(target).removeClass('d-none');
        		$('.carrier_id_'+type).addClass('d-none');
        	}
        }
    </script>
@endsection
