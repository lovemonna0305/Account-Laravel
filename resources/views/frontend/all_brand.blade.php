@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <section class="mb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-lg-left text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ translate('All Brands') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb justify-content-center justify-content-lg-end bg-transparent p-0">
                        <li class="breadcrumb-item has-transition opacity-60 hov-opacity-80">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            <a class="text-dark" href="{{ route('brands.all') }}">{{ translate('All Brands') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- All Brands -->
    <section class="mb-4">
        <div class="container">
            <div class="bg-white px-3 pt-3">
                <div class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                    @foreach ($brands as $brand)
                        <div class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                            <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                    alt="{{ $brand->getTranslation('name') }}">
                                <p class="text-center text-dark fs-14 fw-700 mt-2">{{ $brand->getTranslation('name') }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
