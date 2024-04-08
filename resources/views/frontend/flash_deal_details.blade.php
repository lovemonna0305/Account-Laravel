@extends('frontend.layouts.app')

@section('content')
    <section class="mb-5 mt-3">
        <div class="container">
            <!-- Top Section -->
            <div class="pt-2 pt-lg-4 mb-2 mb-lg-4">
                <!-- Title -->
                <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ $flash_deal->title }}</h1>
            </div>

            <div class="row gutters-16">
                <!-- Flash Deals Baner & Countdown -->
                <div class="col-xxl-4 col-lg-5">
                    <div class="z-3 sticky-top-flash-deal py-3 py-lg-0 h-400px h-md-570px h-lg-400px h-xl-475px">
                        <div class="h-100 w-100 w-xl-auto" style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">
                            <div class="py-5 px-2 px-lg-3 px-xl-5">
                                <div class="bg-white">
                                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Flash Deals Products -->
                <div class="col-xxl-8 col-lg-7">
                    @if($flash_deal->status == 1 && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date) 
                        <div class="px-3 z-5">
                            <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-3 row-cols-sm-2 row-cols-2 gutters-16 border-top border-left">
                                @foreach ($flash_deal->flash_deal_products->take(20) as $key => $flash_deal_product)
                                    @php
                                        $product = \App\Models\Product::find($flash_deal_product->product_id);
                                    @endphp
                                    @if ($product != null && $product->published != 0)
                                        @php
                                            $product_url = route('product', $product->slug);
                                            if($product->auction_product == 1) {
                                                $product_url = route('auction-product', $product->slug);
                                            }
                                        @endphp
                                        <div class="col text-center border-right border-bottom has-transition hov-shadow-out z-1">
                                            @include('frontend.partials.product_box_1',['product' => $product])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center text-{{ $flash_deal->text_color }}">
                            <h1 class="h3 my-4">{{ $flash_deal->title }}</h1>
                            <p class="h4">{{  translate('This offer has been expired.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
