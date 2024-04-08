@extends('frontend.layouts.app')

@section('content')

<section id="coupons" class="bg-white pb-5">
    <div class="container">
        <h1 class="d-block my-5 fs-20 fs-md-24 fw-700 text-dark">{{ translate('All coupons') }}</h1>
        <div class="row gutters-16 row-cols-xl-3 row-cols-md-2 row-cols-1">
            @foreach($coupons as $key => $coupon)
                @if($coupon->user->user_type == 'admin' || ($coupon->user->shop != null && $coupon->user->shop->verification_status))
                    <div class="col mb-4">
                        @include('frontend.partials.coupon_box',['coupon' => $coupon])
                    </div>  
                @endif
            @endforeach
        </div>
    </div>
</section>

@endsection