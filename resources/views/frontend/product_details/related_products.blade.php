<div class="bg-white border">
    <div class="p-3 p-sm-4">
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