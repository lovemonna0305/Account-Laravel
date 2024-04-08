<div class="bg-white border mb-4">
    <div class="p-3 p-sm-4">
        <h3 class="fs-16 fw-700 mb-0">
            <span class="mr-4">{{ translate('Reviews & Ratings') }}</span>
        </h3>
    </div>
    <!-- Ratting -->
    <div class="px-3 px-sm-4 mb-4">
        <div class="border border-warning bg-soft-warning p-3 p-sm-4">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3">
                    <div class="d-flex align-items-center justify-content-between justify-content-md-start">
                        <div class="w-100 w-sm-auto">
                            <span class="fs-36 mr-3">{{ $detailedProduct->rating }}</span>
                            <span class="fs-14 mr-3">{{ translate('out of 5.0') }}</span>
                        </div>
                        <div class="mt-sm-3 w-100 w-sm-auto d-flex flex-wrap justify-content-end justify-content-md-start">
                            @php
                                $total = 0;
                                $total += $detailedProduct->reviews->count();
                            @endphp
                            <span class="rating rating-mr-1">
                                {{ renderStarRating($detailedProduct->rating) }}
                            </span>
                            <span class="ml-1 fs-14">({{ $total }}
                                {{ translate('reviews') }})</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a  href="javascript:void(0);" onclick="product_review('{{ $detailedProduct->id }}')" 
                        class="btn btn-warning fw-400 rounded-0 text-white">
                        <span class="d-md-inline-block"> {{ translate('Rate this Product') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews -->
    @include('frontend.product_details.reviews')
</div>