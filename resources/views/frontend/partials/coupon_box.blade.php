@if ($key == 0 || ($key+1 > 3 && ($key+1 -(floor(($key+1)%3)*3)) == 1))
    @php $bg = "linear-gradient(to right, #e2583e 0%, #bf1931 100%);"; @endphp
@elseif ($key == 1 || ($key+1 > 3 && ($key+1 -(floor(($key+1)%3)*3)) == 2))
    @php $bg = "linear-gradient(to right, #7cc4c3 0%, #479493 100%);"; @endphp
@elseif ($key == 2 || ($key+1 > 3 && ($key+1 -(floor(($key+1)%3)*3)) == 3))
    @php $bg = "linear-gradient(to right, #98b3d1 0%, #5f4a8b 100%);"; @endphp
@endif

@if($coupon->type == 'product_base')
    @php 
        $products = json_decode($coupon->details); 
        $coupon_products = [];
        foreach($products as $product) {                            
            array_push($coupon_products, $product->product_id);                           
        }
    @endphp
@else                 
    @php 
        $order_discount = json_decode($coupon->details); 
    @endphp             
@endif
@php 
    if($coupon->user->user_type != 'admin') {
        $shop = $coupon->user->shop;
        $name = $shop->name;
    }
    else {
        $name = get_setting('website_name');
    }
@endphp

<div style="min-height: 232px; border-radius: 24px; background: {{ $bg }};" class="d-flex align-items-center position-relative">

    <!-- Shop Name & discount -->
    <div class="position-absolute" style="top:2rem; left:2rem;">
        <h3 class="fs-13 text-white fw-500 px-3">{{ $name }}
            @if (\Request::route()->getName() == 'coupons.all')
                <a 
                    @if($coupon->user->user_type != 'admin')
                        href="{{ route('shop.visit', $shop->slug) }}"
                    @else 
                        href="{{ route('inhouse.all') }}"
                    @endif
                    class="ml-3 text-white hov-text-warning fs-13" style="text-decoration: underline;"
                >
                    {{ translate('Visit Store') }}
                </a>
            @endif
        </h3>
        <div class="align-self-center px-3 flex-grow-1 text-white">
            @if($coupon->discount_type == 'amount')
                <p class="fs-16 fw-500 mb-1">{{ single_price($coupon->discount) }} {{ translate('OFF') }}</p>    
            @else
                <p class="fs-16 fw-500 mb-1">{{ $coupon->discount }}% {{ translate('OFF') }}</p>    
            @endif
        </div>
    </div>
    
    <!-- Middle design -->
    <div class="d-flex jystify-content-between align-items-center w-100 position-absolute">
        <span class="bg-white rounded-content" style="min-height: 48px; min-width: 48px; margin-left: -24px;"></span>
        <hr class="border border-dashed border-white opacity-40 w-100 mx-2">
        <span class="bg-white rounded-content" style="min-height: 48px; min-width: 48px; margin-right: -24px;"></span>
    </div>

    <!-- Coupon Details -->
    <div class="position-absolute" style="bottom:1rem; left:2rem; right:2rem">
        <div class="px-4 mt-2">
            @if($coupon->type == 'product_base')
                <!-- Coupon Products -->
                @php $products = App\Models\Product::whereIn('id', $coupon_products)->get(); @endphp
                <div class="aiz-carousel coupon-slider gutters-16 arrow-none" data-items="6" data-lg-items="6"  data-md-items="4" data-sm-items="4" data-xs-items="4" data-arrows='true' data-infinite='true' data-autoplay="true">
                    @foreach($products as $key => $product)
                        <a href="{{ route('product', $product->slug) }}" title="{{ $product->name }}" class='p-1 border border-transparent hov-border' target="_blank">
                            <img class="img-fit mx-auto h-48px w-48px" 
                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                alt="">
                        </a>
                    @endforeach      
                </div>       
            @else
                <!-- Coupon Discount range -->
                <span class="fs-12 text-white pb-lg-3 d-block m-auto ">
                    @if($coupon->discount_type == 'amount')
                        {{ translate('Min Spend ') }} <strong>{{ single_price($order_discount->min_buy) }}</strong> {{ translate('from') }} <strong>{{ $name }}</strong> {{ translate('to get') }} <strong>{{ single_price($coupon->discount) }}</strong> {{ translate('OFF on total orders') }}
                    @else 
                        {{ translate('Min Spend ') }} <strong>{{ single_price($order_discount->min_buy) }}</strong> {{ translate('from') }} <strong>{{ $name }}</strong> {{ translate('to get') }} <strong>{{ $coupon->discount }}%</strong> {{ translate('OFF on total orders') }}                                   
                    @endif
                </span>
            @endif
        </div>
        
        <!-- Coupon Code -->
        <div class="text-right">
            <span class="fs-13 d-block mb-0 text-white">
                {{ translate('Code') }}:
                <span class="fw-600">{{ $coupon->code }}</span>
                <span class="ml-2 text-white fs-16" style="cursor:pointer;" onclick="copyCouponCode('{{ $coupon->code }}')" data-toggle="tooltip" data-title="{{ translate('Copy the Code') }}" data-placement="top"><i class="las la-copy"></i></span>
            </span>
        </div>
    </div>
</div>