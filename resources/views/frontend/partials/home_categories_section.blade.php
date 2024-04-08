@if(get_setting('home_categories') != null) 
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    @foreach ($home_categories as $key1 => $value)
        @php $category = \App\Models\Category::find($value); @endphp
        <section class="@if($key1 != 0) mt-4 @endif" style="">
            <div class="container">
                <div class="row gutters-16">
                    <!-- Home category Baner & name -->
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="h-200px h-sm-250px h-md-340px">
                            <div class="h-100 w-100 w-xl-auto position-relative hov-scale-img overflow-hidden">
                                <div class="position-absolute h-100 w-100 overflow-hidden">
                                    <img src="{{ uploaded_asset($category->cover_image) }}" alt="{{ $category->getTranslation('name') }}" class="img-fit h-100 has-transition"  
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                                <div class="pb-4 px-3 absolute-bottom-left w-100 has-transition h-100 d-flex flex-column align-items-center justify-content-end" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0) 100%) !important;">
                                    <a class="fs-16 fw-700 text-white text-center animate-underline-white home-category-name d-flex align-items-center hov-column-gap-1" href="{{ route('products.category', $category->slug) }}" style="width: max-content;">{{ $category->getTranslation('name') }}&nbsp;<i class="las la-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category Products -->
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="aiz-carousel arrow-x-0 border-right arrow-inactive-none" data-items="5" data-xxl-items="5" data-xl-items="4.5" data-lg-items="3"  data-md-items="2" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='false'>
                            @foreach (get_cached_products($category->id)->take(5) as $key => $product)
                            <div class="carousel-box px-3 position-relative has-transition border-right border-top border-bottom @if($key == 0) border-left @endif hov-animate-outline">
                                @include('frontend.partials.product_box_1',['product' => $product])
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif

