@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
@endsection

@section('content')
    <section class="mb-4 pt-3">
        <div class="container">
            <div class="bg-white shadow-sm rounded p-3">
                <div class="row">
                    <!-- Product Photos -->
                    <div class="col-xl-5 col-lg-6 mb-4">
                        <div class="sticky-top z-3 row gutters-10">
                            @if($detailedProduct->photos != null)
                                @php
                                    $photos = explode(',',$detailedProduct->photos);
                                @endphp
                                <div class="col order-1 order-md-2">
                                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' 
                                        data-fade='true' data-auto-height='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box img-zoom rounded">
                                            <img class="img-fluid lazyload"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-auto w-80px w-md-90px order-2 order-md-1 mt-3 mt-md-0">
                                    <div class="aiz-carousel carousel-thumb product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                                        @foreach ($photos as $key => $photo)
                                        <div class="carousel-box c-pointer border rounded-0">
                                            <img class="lazyload mw-100 size-60px mx-auto"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="col-xl-7 col-lg-6">
                        <div class="text-left">
                            <!-- Product Name -->
                            <h1 class="mb-4 fs-16 fw-700 text-dark">
                                {{ $detailedProduct->getTranslation('name') }}
                            </h1>

                            <div class="row justify-content-between">
                                <div class="col-md-6 mb-3">
                                    <div class="row align-items-center">
                                        <!-- Review -->
                                        <div class="col-12">
                                            @php
                                                $total = 0;
                                                $total += $detailedProduct->reviews->count();
                                            @endphp
                                            <span class="rating rating-mr-1">
                                                {{ renderStarRating($detailedProduct->rating) }}
                                            </span>
                                            <span class="ml-1 opacity-50 fs-14">({{ $total }}
                                                {{ translate('reviews') }})</span>
                                        </div>
                                        <!-- In stock -->
                                        <div class="col-12 mt-1">
                                            <span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-md-end">
                                        <!-- Add to wishlist button -->
                                        <a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" class="mr-3 fs-14 text-dark opacity-60 has-transitiuon hov-opacity-100">
                                            <i class="la la-heart-o mr-1"></i>
                                            {{ translate('Add to Wishlist') }}
                                        </a>
                                        <!-- Add to compare button -->
                                        <a href="javascript:void(0)" onclick="addToCompare({{ $detailedProduct->id }})" class="fs-14 text-dark opacity-60 has-transitiuon hov-opacity-100">
                                            <i class="las la-sync mr-1"></i>
                                            {{ translate('Add to Compare') }}
                                        </a>
                                    </div>
                                    <div class="text-md-right mt-1">
                                        <a href="#" class="text-blue hov-text-primary fs-14">{{ translate('Ask about this product') }}</a>
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <!-- Seller Info -->
                            <div class="row align-items-center">
                                <div class="col-md-4 fs-14 fw-700 mb-3">
                                    <div class="d-flex">
                                        <!-- Shop Logo -->
                                        @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="size-40px rounded-content mr-2 overflow-hidden border">
                                            <img class="lazyload img-fit h-100 mx-auto"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ uploaded_asset($detailedProduct->user->shop->logo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </a>
                                        @endif
                                        <!-- Shop Name -->
                                        <div>
                                            <span class="opacity-60 fw-400">{{ translate('Sold by') }}</span><br>
                                            @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                                    class="text-reset hov-text-primary">{{ $detailedProduct->user->shop->name }}</a>
                                            @else
                                                {{ translate('Inhouse product') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Messase to seller -->
                                @if (get_setting('conversation_system') == 1)
                                    <div class="col-md-4 text-md-right mb-3">
                                        <button class="btn btn-sm btn-soft-warning rounded-0 hov-svg-white hov-text-white"
                                            onclick="show_chat_modal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr-2 has-transition">
                                                <g id="Group_23918" data-name="Group 23918" transform="translate(1053.151 256.688)">
                                                  <path id="Path_3012" data-name="Path 3012" d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z" transform="translate(-1178 -341)" fill="#f4b650"/>
                                                  <path id="Path_3013" data-name="Path 3013" d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1" transform="translate(-1182 -337)" fill="#f4b650"/>
                                                  <path id="Path_3014" data-name="Path 3014" d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1" transform="translate(-1181 -343.5)" fill="#f4b650"/>
                                                  <path id="Path_3015" data-name="Path 3015" d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1" transform="translate(-1181 -346.5)" fill="#f4b650"/>
                                                </g>
                                              </svg>
                                              
                                            {{ translate('Message Seller') }}
                                        </button>
                                    </div>
                                @endif
                                <!-- Brand Logo & Name -->
                                @if ($detailedProduct->brand != null)
                                    <div class="col-md-4 fs-14 fw-700 mb-3">
                                        <div class="d-flex">
                                            <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}" class="size-40px rounded-content mr-2 overflow-hidden border p-1">
                                                <img class="lazyload img-fit h-100 mx-auto"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($detailedProduct->brand->logo) }}"
                                                    alt="{{ $detailedProduct->brand->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </a>
                                            <div>
                                                <span class="opacity-60 fw-400">{{ translate('Brand') }}</span><br>
                                                <a href="{{ route('shop.visit', $detailedProduct->brand->slug) }}"
                                                    class="text-reset hov-text-primary">{{ $detailedProduct->brand->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr>

                            @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                
                                <div class="row no-gutters mb-3">
                                    <div class="col-sm-2">
                                        <div class="text-secondary fs-14 fw-400">{{ translate('Price')}}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="d-flex align-items-center">
                                            <!-- Discount Price -->
                                            <strong class="fs-16 fw-700 text-primary">
                                                {{ home_discounted_price($detailedProduct) }}
                                            </strong>
                                            <!-- Home Price -->
                                            <del class="fs-14 opacity-60 ml-2">
                                                {{ home_price($detailedProduct) }}
                                            </del>
                                            <!-- Unit -->
                                            @if($detailedProduct->unit != null)
                                                <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif
                                            <!-- Discount percentage -->
                                            @if(discount_in_percentage($detailedProduct) > 0)
                                                <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1" style="padding-top:2px;padding-bottom:2px;">-{{discount_in_percentage($detailedProduct)}}%</span>
                                            @endif
                                            <!-- Club Point -->
                                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1" style="width: fit-content;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                                        <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6" r="6" transform="translate(973 633)" fill="#fff"/>
                                                        <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                                            <path id="Path_28698" data-name="Path 28698" d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)" fill="#f3af3d"/>
                                                            <path id="Path_28699" data-name="Path 28699" d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)" fill="#f3af3d" opacity="0.5"/>
                                                            <path id="Path_28700" data-name="Path 28700" d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)" fill="#f3af3d"/>
                                                        </g>
                                                        </g>
                                                    </svg>
                                                    <small class="fs-11 fw-500 text-white ml-2">{{  translate('Club Point') }}: {{ $detailedProduct->earn_point }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row no-gutters mb-3">
                                    <div class="col-sm-2">
                                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="">
                                            <!-- Discount Price -->
                                            <strong class="fs-16 fw-700 text-primary">
                                                {{ home_discounted_price($detailedProduct) }}
                                            </strong>
                                            <!-- Unit -->
                                            @if ($detailedProduct->unit != null)
                                                <span
                                                    class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif
                                            <!-- Club Point -->
                                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                                <div class="ml-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1" style="width: fit-content;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                                        <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6" r="6" transform="translate(973 633)" fill="#fff"/>
                                                        <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                                            <path id="Path_28698" data-name="Path 28698" d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)" fill="#f3af3d"/>
                                                            <path id="Path_28699" data-name="Path 28699" d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)" fill="#f3af3d" opacity="0.5"/>
                                                            <path id="Path_28700" data-name="Path 28700" d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)" fill="#f3af3d"/>
                                                        </g>
                                                        </g>
                                                    </svg>
                                                    <small class="fs-11 fw-500 text-white ml-2">{{  translate('Club Point') }}: {{ $detailedProduct->earn_point }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form id="option-choice-form" class="mb-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                <!-- Total Price -->
                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-sm-2">
                                        <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price') }}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="product-price">
                                            <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <!-- Add to cart & Buy now Buttons -->
                            <div class="mt-3">
                                <button type="button" class="btn btn-warning mr-2 add-to-cart fw-600 w-150px rounded-0 text-white" onclick="addToCart()">
                                    <i class="las la-shopping-bag"></i>
                                    <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                                </button>
                                <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart w-150px rounded-0" onclick="buyNow()">
                                    <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                </button>
                            </div>

                            <!-- Promote Link -->
                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    @if(Auth::check() && addon_is_activated('affiliate_system') && (\App\Models\AffiliateOption::where('type', 'product_sharing')->first()->status || \App\Models\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                        @php
                                            if(Auth::check()){
                                                if(Auth::user()->referral_code == null){
                                                    Auth::user()->referral_code = substr(Auth::user()->id.Str::random(10), 0, 10);
                                                    Auth::user()->save();
                                                }
                                                $referral_code = Auth::user()->referral_code;
                                                $referral_code_url = URL::to('/product').'/'.$detailedProduct->slug."?product_referral_code=$referral_code";
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <textarea id="referral_code_url" class="form-control" readonly type="text" style="display:none">{{$referral_code_url}}</textarea>
                                        </div>
                                        <button type="button" id="ref-cpurl-btn" class="btn btn-sm btn-secondary w-150px rounded-0" data-attrcpy="{{ translate('Copied')}}" onclick="CopyToClipboard('referral_code_url')">{{ translate('Copy the Promote Link')}}</button>
                                    @endif
                                </div>
                            </div>

                            <!-- Refund -->
                            @php
                                $refund_sticker = get_setting('refund_sticker');
                            @endphp
                            @if (addon_is_activated('refund_request'))
                                <div class="row no-gutters mt-3">
                                    <div class="col-sm-2">
                                        <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Refund') }}</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <a href="{{ route('returnpolicy') }}" target="_blank">
                                            @if ($refund_sticker != null)
                                                <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                                            @else
                                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}"
                                                    height="36">
                                            @endif
                                        </a>
                                        <a href="{{ route('returnpolicy') }}" class="text-blue hov-text-primary fs-14 ml-2"
                                            target="_blank">{{ translate('View Policy') }}</a>
                                    </div>
                                </div>
                            @endif

                            <!-- Seller Guarantees -->
                            @if ($detailedProduct->added_by == 'seller')
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="text-secondary fs-14 fw-400">{{ translate('Seller Guarantees')}}</div>
                                    </div>
                                    <div class="col-10">
                                        @if ($detailedProduct->user->shop->verification_status == 1)
                                            <span class="text-success fs-14 fw-700">{{ translate('Verified seller')}}</span>
                                        @else
                                            <span class="text-danger fs-14 fw-700">{{ translate('Non verified seller')}}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Share -->
                            <div class="row no-gutters mt-4">
                                <div class="col-sm-2">
                                    <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Share') }}</div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="aiz-share"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="row gutters-16">
                
                <!-- Left side -->
                <div class="col-xl-3 order-1 order-xl-0">

                    <!-- Seller Info -->
                    @if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->shop != null)
                        <div class="border mb-4" style="background: #fcfcfd;">
                            <div class="position-relative p-4 text-left">
                                @if ($detailedProduct->user->shop->verification_status)
                                    <div class="absolute-top-right mr-4 bg-white z-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="31.999" height="48.001" viewBox="0 0 31.999 48.001">
                                            <g id="Group_24169" data-name="Group 24169" transform="translate(-532 -1033.999)">
                                              <path id="Union_3" data-name="Union 3" d="M1937,12304h16v14Zm-16,0h16l-16,14Zm0,0v-34h32v34Z" transform="translate(-1389 -11236)" fill="#85b567"/>
                                              <path id="Union_5" data-name="Union 5" d="M1921,12280a10,10,0,1,1,10,10A10,10,0,0,1,1921,12280Zm1,0a9,9,0,1,0,9-9A9.011,9.011,0,0,0,1922,12280Zm1,0a8,8,0,1,1,8,8A8.009,8.009,0,0,1,1923,12280Zm4.26-1.033a.891.891,0,0,0-.262.636.877.877,0,0,0,.262.632l2.551,2.551a.9.9,0,0,0,.635.266.894.894,0,0,0,.639-.266l4.247-4.244a.9.9,0,0,0-.639-1.542.893.893,0,0,0-.635.266l-3.612,3.608-1.912-1.906a.89.89,0,0,0-1.274,0Z" transform="translate(-1383 -11226)" fill="#fff"/>
                                            </g>
                                        </svg>
                                    </div>
                                @endif
                                <div class="opacity-60 fs-12">{{ translate('Seller')}}</div>
                                <div class="d-flex mt-1">
                                    <!-- Shop Logo -->
                                    @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="h-60px w-70px rounded-content mr-2 overflow-hidden border">
                                        <img class="lazyload img-fit h-100 mx-auto"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($detailedProduct->user->shop->logo) }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </a>
                                    @endif
                                    <!-- Shop Name -->
                                    <div>
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="text-reset d-block fw-700">
                                            {{ $detailedProduct->user->shop->name }}
                                            @if ($detailedProduct->user->shop->verification_status == 1)
                                                <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                            @else
                                                <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                            @endif
                                        </a>
                                        <div class="location opacity-70">{{ $detailedProduct->user->shop->address }}</div>
                                    </div>
                                </div>
                                <!-- Ratting -->
                                <div class="mt-3">
                                    <div class="rating rating-mr-1">
                                        @if ($total > 0)
                                            {{ renderStarRating($detailedProduct->user->shop->rating) }}
                                        @else
                                            {{ renderStarRating(0) }}
                                        @endif
                                    </div>
                                    <div class="opacity-60 fs-12">({{ $total }}
                                        {{ translate('customer reviews') }})</div>
                                </div>
                                <!-- Social Links -->
                                <div class="mt-3">
                                    <ul class="social list-inline mb-0">
                                        <li class="list-inline-item mr-2">
                                            <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook"
                                                target="_blank">
                                                <i class="lab la-facebook-f opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mr-2">
                                            <a href="{{ $detailedProduct->user->shop->google }}" class="google"
                                                target="_blank">
                                                <i class="lab la-google opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item mr-2">
                                            <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter"
                                                target="_blank">
                                                <i class="lab la-twitter opacity-60"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube"
                                                target="_blank">
                                                <i class="lab la-youtube opacity-60"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- shop link button -->
                                <div class="mt-3">
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                                        class="btn btn-block btn-warning text-white fs-14 fw-700 rounded-0">{{ translate('Visit Store') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Top Selling Products -->
                    <div class="bg-white border mb-4">
                        <div class="p-4 fs-16 fw-600">
                            {{ translate('Top Selling Products') }}
                        </div>
                        <div class="px-4 pb-4">
                            <ul class="list-group list-group-flush">
                                @foreach (filter_products(\App\Models\Product::where('user_id', $detailedProduct->user_id)
                                            ->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                                    <li class="py-3 px-0 list-group-item border-0">
                                        <div class="row gutters-10 align-items-center hov-scale-img hov-shadow-md overflow-hidden has-transition">
                                            <div class="col-4">
                                                <!-- Image -->
                                                <a href="{{ route('product', $top_product->slug) }}"
                                                    class="d-block text-reset">
                                                    <img class="img-fit lazyload h-xl-80px h-120px has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                        alt="{{ $top_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col-8 text-left">
                                                <!-- Product name -->
                                                <h4 class="fs-14 fw-400 text-truncate-2">
                                                    <a href="{{ route('product', $top_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $top_product->getTranslation('name') }}</a>
                                                </h4>
                                                <div class="mt-2 ">
                                                    <!-- Price -->
                                                    <span class="fs-14 fw-700 text-primary">{{ home_discounted_base_price($top_product) }}</span>
                                                    <!-- Home Price -->
                                                    @if(home_price($top_product) != home_discounted_price($top_product))
                                                    <del class="fs-14 fw-700 opacity-60 ml-1">
                                                        {{ home_price($top_product) }}
                                                    </del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- Right side -->
                <div class="col-xl-9 order-0 order-xl-1">

                    <!-- Description, Video, Downloads -->
                    <div class="bg-white mb-4 border p-4">
                        <!-- Tabs -->
                        <div class="nav aiz-nav-tabs">
                            <a href="#tab_default_1" data-toggle="tab"
                                class="mr-5 pb-2 fs-16 fw-700 text-reset active show">{{ translate('Description') }}</a>
                            @if ($detailedProduct->video_link != null)
                                <a href="#tab_default_2" data-toggle="tab"
                                    class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Video') }}</a>
                            @endif
                            @if ($detailedProduct->pdf != null)
                                <a href="#tab_default_3" data-toggle="tab"
                                    class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Downloads') }}</a>
                            @endif
                            <a href="#tab_default_4" data-toggle="tab"
                                class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Reviews') }}</a>
                        </div>

                        <!-- Description -->
                        <div class="tab-content pt-0">
                            <!-- Description -->
                            <div class="tab-pane fade active show" id="tab_default_1">
                                <div class="py-5">
                                    <div class="mw-100 overflow-hidden text-left aiz-editor-data">
                                        <?php echo $detailedProduct->getTranslation('description'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Video -->
                            <div class="tab-pane fade" id="tab_default_2">
                                <div class="py-5">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item"
                                                src="https://www.youtube.com/embed/{{ get_url_params($detailedProduct->video_link, 'v') }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item"
                                                src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                            <iframe
                                                src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                                                width="500" height="281" frameborder="0" webkitallowfullscreen
                                                mozallowfullscreen allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Download -->
                            <div class="tab-pane fade" id="tab_default_3">
                                <div class="py-5 text-center ">
                                    <a href="{{ uploaded_asset($detailedProduct->pdf) }}"
                                        class="btn btn-primary">{{ translate('Download') }}</a>
                                </div>
                            </div>
                            
                            <!-- Review -->
                            <div class="tab-pane fade" id="tab_default_4">
                                <div class="py-5">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            @if ($review->user != null)
                                                <li class="media list-group-item d-flex">
                                                    <span class="avatar avatar-md mr-3">
                                                        <img class="lazyload"
                                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                            @if ($review->user->avatar_original != null) data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                            data-src="{{ static_asset('assets/img/placeholder.jpg') }}" @endif>
                                                    </span>
                                                    <div class="media-body text-left">
                                                        <div class="d-flex justify-content-between">
                                                            <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}
                                                            </h3>
                                                            <span class="rating rating-sm">
                                                                @for ($i = 0; $i < $review->rating; $i++)
                                                                    <i class="las la-star active"></i>
                                                                @endfor
                                                                @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                    <i class="las la-star"></i>
                                                                @endfor
                                                            </span>
                                                        </div>
                                                        <div class="opacity-60 mb-2">
                                                            {{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    @if (count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{ translate('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related products -->
                    <div class="bg-white border">
                        <div class="p-4">
                            <h3 class="fs-16 fw-700 mb-0">
                                <span class="mr-4">{{ translate('Related products') }}</span>
                            </h3>
                        </div>
                        <div class="px-4">
                            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3"
                                data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2"
                                data-arrows='true' data-infinite='true'>
                                @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)
                                            ->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                    <div class="carousel-box">
                                        <div class="aiz-card-box hov-shadow-md my-2 has-transition hov-scale-img">
                                            <div class="">
                                                <a href="{{ route('product', $related_product->slug) }}"
                                                    class="d-block">
                                                    <img class="img-fit lazyload mx-auto h-140px h-md-190px has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                                        alt="{{ $related_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="p-md-3 p-2 text-center">
                                                <h3 class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('product', $related_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $related_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mt-3">
                                                    <span class="fw-700 text-primary">{{ home_discounted_base_price($related_product) }}</span>
                                                    @if (home_base_price($related_product) != home_discounted_base_price($related_product))
                                                        <del
                                                            class="fw-700 opacity-60 ml-1">{{ home_base_price($related_product) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Product Query -->
                    @if(get_setting('product_query_activation') == 1)
                        <div class="bg-white border mt-4">
                            <div class="p-4">
                                <h3 class="fs-16 fw-700 mb-0">
                                    <span>{{ translate(' Product Queries ') }} ({{ $total_query }})</span>
                                </h3>
                            </div>

                            <!-- Login & Register -->
                            @guest
                                <p class="fs-14 fw-400 mb-0 px-4 mt-3"><a
                                        href="{{ route('user.login') }}">{{ translate('Login') }}</a> or <a class="mr-1"
                                        href="{{ route('user.registration') }}">{{ translate('Register ') }}</a>{{ translate(' to submit your questions to seller') }}
                                </p>
                            @endguest

                            <!-- Query Submit -->
                            @auth
                                <div class="query form px-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('product-queries.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product" value="{{ $detailedProduct->id }}">
                                        <div class="form-group">
                                            <textarea class="form-control rounded-0" rows="3" cols="40" name="question"
                                                placeholder="{{ translate('Write your question here...') }}" style="resize: none;"></textarea>
                                            
                                        </div>
                                        <button type="submit" class="btn btn-sm w-150px btn-primary rounded-0">{{ translate('Submit') }}</button>
                                    </form>
                                </div>

                                <!-- Own Queries -->
                                @php
                                    $own_product_queries = Auth::user()->product_queries->where('product_id',$detailedProduct->id);
                                @endphp
                                @if ($own_product_queries->count() > 0)
                                
                                    <div class="question-area my-4 mb-0 px-4">

                                        <div class="py-3">
                                            <h3 class="fs-16 fw-700 mb-0">
                                                <span class="mr-4">{{ translate('My Questions') }}</span>
                                            </h3>
                                        </div>
                                        @foreach ($own_product_queries as $product_query)
                                            <div class="produc-queries mb-4">
                                                <div class="query d-flex my-2">
                                                    <span class="mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="24.994"
                                                            height="24.981" viewBox="0 0 24.994 24.981">
                                                            <g id="Group_23909" data-name="Group 23909"
                                                                transform="translate(18392.496 11044.037)">
                                                                <path id="Subtraction_90" data-name="Subtraction 90"
                                                                    d="M1830.569-117.742a.4.4,0,0,1-.158-.035.423.423,0,0,1-.252-.446c0-.84,0-1.692,0-2.516v-2.2a5.481,5.481,0,0,1-2.391-.745,5.331,5.331,0,0,1-2.749-4.711c-.034-2.365-.018-4.769,0-7.094l0-.649a5.539,5.539,0,0,1,4.694-5.513,5.842,5.842,0,0,1,.921-.065q3.865,0,7.73,0l5.035,0a5.539,5.539,0,0,1,5.591,5.57c.01,2.577.01,5.166,0,7.693a5.54,5.54,0,0,1-4.842,5.506,6.5,6.5,0,0,1-.823.046l-3.225,0c-1.454,0-2.753,0-3.97,0a.555.555,0,0,0-.435.182c-1.205,1.214-2.435,2.445-3.623,3.636l-.062.062-1.005,1.007-.037.037-.069.069A.464.464,0,0,1,1830.569-117.742Zm7.37-11.235h0l1.914,1.521.817-.754-1.621-1.273a3.517,3.517,0,0,0,1.172-1.487,5.633,5.633,0,0,0,.418-2.267v-.58a5.629,5.629,0,0,0-.448-2.323,3.443,3.443,0,0,0-1.282-1.525,3.538,3.538,0,0,0-1.93-.53,3.473,3.473,0,0,0-1.905.534,3.482,3.482,0,0,0-1.288,1.537,5.582,5.582,0,0,0-.454,2.314v.654a5.405,5.405,0,0,0,.471,2.261,3.492,3.492,0,0,0,1.287,1.5,3.492,3.492,0,0,0,1.9.527,3.911,3.911,0,0,0,.947-.112Zm-.948-.9a2.122,2.122,0,0,1-1.812-.9,4.125,4.125,0,0,1-.652-2.457v-.667a4.008,4.008,0,0,1,.671-2.4,2.118,2.118,0,0,1,1.78-.863,2.138,2.138,0,0,1,1.824.869,4.145,4.145,0,0,1,.639,2.473v.673a4.07,4.07,0,0,1-.655,2.423A2.125,2.125,0,0,1,1836.991-129.881Z"
                                                                    transform="translate(-20217 -10901.814)" fill="#e62e04"
                                                                    stroke="rgba(0,0,0,0)" stroke-miterlimit="10"
                                                                    stroke-width="1" />
                                                            </g>
                                                        </svg></span>

                                                    <div class="ml-3">
                                                        <div class="fs-14">{{ strip_tags($product_query->question) }}</div>
                                                        <span class="text-secondary">{{ $product_query->user->name }} </span>
                                                    </div>
                                                </div>
                                                <div class="answer d-flex my-2">
                                                    <span class="mt-1"> <svg xmlns="http://www.w3.org/2000/svg" width="24.99"
                                                            height="24.98" viewBox="0 0 24.99 24.98">
                                                            <g id="Group_23908" data-name="Group 23908"
                                                                transform="translate(17952.169 11072.5)">
                                                                <path id="Subtraction_89" data-name="Subtraction 89"
                                                                    d="M2162.9-146.2a.4.4,0,0,1-.159-.035.423.423,0,0,1-.251-.446q0-.979,0-1.958V-151.4a5.478,5.478,0,0,1-2.39-.744,5.335,5.335,0,0,1-2.75-4.712c-.034-2.355-.018-4.75,0-7.065l0-.678a5.54,5.54,0,0,1,4.7-5.513,5.639,5.639,0,0,1,.92-.064c2.527,0,5.029,0,7.437,0l5.329,0a5.538,5.538,0,0,1,5.591,5.57c.01,2.708.01,5.224,0,7.692a5.539,5.539,0,0,1-4.843,5.506,6,6,0,0,1-.822.046l-3.234,0c-1.358,0-2.691,0-3.96,0a.556.556,0,0,0-.436.182c-1.173,1.182-2.357,2.367-3.5,3.514l-1.189,1.192-.047.048-.058.059A.462.462,0,0,1,2162.9-146.2Zm5.115-12.835h3.559l.812,2.223h1.149l-3.25-8.494h-.98l-3.244,8.494h1.155l.8-2.222Zm3.226-.915h-2.888l1.441-3.974,1.447,3.972Z"
                                                                    transform="translate(-20109 -10901.815)" fill="#f7941d"
                                                                    stroke="rgba(0,0,0,0)" stroke-miterlimit="10"
                                                                    stroke-width="1" />
                                                            </g>
                                                        </svg></span>

                                                    <div class="ml-3">
                                                        <div class="fs-14">
                                                            {{ strip_tags($product_query->reply ? $product_query->reply : translate('Seller did not respond yet')) }}
                                                        </div>
                                                        <span class=" text-secondary">
                                                            {{ $product_query->product->user->name }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                
                                @endif
                            @endauth
                                    
                            <!-- Others Queries -->
                            <div class="pagination-area my-4 mb-0 px-4">
                                @include('frontend.partials.product_query_pagination')
                            </div>
                        </div>
                    @endif
                    <!-- End of Product Query -->

                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 heading-5">{{ translate('Any question about this product?')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->getTranslation('name') }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (addon_is_activated('otp_system'))
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (addon_is_activated('otp_system'))
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(get_setting('google_login') == 1 ||
                            get_setting('facebook_login') == 1 ||
                            get_setting('twitter_login') == 1 ||
                            get_setting('apple_login') == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (get_setting('facebook_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(get_setting('google_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('twitter_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (get_setting('apple_login') == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                            <i class="lab la-apple"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
    		$('#share').share({
    			showLabel: false,
                showCount: false,
                shares: ["email", "twitter", "facebook", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
    		});
    	});

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }
    </script>
@endsection
