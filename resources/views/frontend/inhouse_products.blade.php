@extends('frontend.layouts.app')

@section('content')

    <section class="mb-4 pt-5">
        <div class="container">
            <h1 class="fw-700 fs-24 text-dark mb-4">{{ translate('Inhouse products') }}</h1>
            <div class="px-3">
                <div class="row gutters-16 row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 border-top border-left">
                    @foreach ($products as $key => $product)
                        <div class="col border-right border-bottom has-transition hov-shadow-out z-1">
                            @include('frontend.partials.product_box_1',['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="aiz-pagination mt-4">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </section>

@endsection

