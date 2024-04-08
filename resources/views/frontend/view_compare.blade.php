@extends('frontend.layouts.app')

@section('content')

    <section class="mb-4 mt-3">
        <div class="container text-left">
            <div class="bg-white shadow-sm rounded">
                <div class="py-3 d-flex justify-content-between align-items-center">
                    <div class="fs-16 fs-md-20 fw-700 text-dark">{{ translate('Compare Products')}}</div>
                    <a href="{{ route('compare.reset') }}" style="text-decoration: none;border-radius: 25px;" class="btn btn-soft-primary btn-sm fs-12 fw-600">{{ translate('Reset Compare List')}}</a>
                </div>
                @if(Session::has('compare'))
                    @if(count(Session::get('compare')) > 0)
                        <div class="py-3">
                            <div class="row gutters-16 mb-4">
                                @foreach (Session::get('compare') as $key => $item)
                                    @php
                                        $product = \App\Models\Product::find($item);
                                    @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 py-3">
                                        <div class="border">
                                            <!-- Product Name -->
                                            <div class="p-4 border-bottom">
                                                <span class="fs-12 text-gray">{{ translate('Name')}}</span>
                                                <h5 class="mb-0 text-dark h-45px text-truncate-2 mt-1">
                                                    <a class="text-reset fs-14 fw-700 hov-text-primary" href="{{ route('product', \App\Models\Product::find($item)->slug) }}" title="{{ \App\Models\Product::find($item)->getTranslation('name') }}">
                                                        {{ \App\Models\Product::find($item)->getTranslation('name') }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <!-- Product Image -->
                                            <div class="p-4 border-bottom">
                                                <span class="fs-12 text-gray">{{ translate('Image')}}</span>
                                                <div>
                                                    <img loading="lazy" src="{{ uploaded_asset(\App\Models\Product::find($item)->thumbnail_img) }}" alt="{{ translate('Product Image') }}" class="img-fluid py-4 h-180px h-sm-220px">
                                                </div>
                                            </div>
                                            <!-- Price -->
                                            <div class="p-4 border-bottom">
                                                <span class="fs-12 text-gray">{{ translate('Price')}}</span>
                                                <h5 class="mb-0 fs-14 mt-1">
                                                    @if(home_base_price($product) != home_discounted_base_price($product))
                                                        <del class="fw-400 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                                    @endif
                                                    <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                                </h5>
                                            </div>
                                            <!-- Category -->
                                            <div class="p-4 border-bottom">
                                                <span class="fs-12 text-gray">{{ translate('Category')}}</span>
                                                <h5 class="mb-0 fs-14 text-dark mt-1">
                                                    @if (\App\Models\Product::find($item)->category != null)
                                                        {{ \App\Models\Product::find($item)->category->getTranslation('name') }}
                                                    @endif
                                                </h5>
                                            </div>
                                            <!-- Brand -->
                                            <div class="p-4 border-bottom">
                                                <span class="fs-12 text-gray">{{ translate('Brand')}}</span>
                                                <h5 class="mb-0 fs-14 text-dark mt-1">
                                                    @if (\App\Models\Product::find($item)->brand != null)
                                                        {{ \App\Models\Product::find($item)->brand->getTranslation('name') }}
                                                    @endif
                                                </h5>
                                            </div>
                                            <!-- Add to cart -->
                                            <div class="p-4">
                                                <button type="button" class="btn btn-block btn-dark rounded-0 fs-13 fw-700 has-transition opacity-80 hov-opacity-100" onclick="showAddToCartModal({{ $item }})">
                                                    {{ translate('Add to cart')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center p-4">
                        <p class="fs-17">{{ translate('Your comparison list is empty')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
