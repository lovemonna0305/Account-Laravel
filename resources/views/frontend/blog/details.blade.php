@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<section class="py-4">
    <div class="container">
        <div class="row gutters-16 justify-content-center">

            <!-- Blog Details -->
            <div class="col-xl-7 col-lg-8">
                <div class="mb-4">
                    <!-- Title -->
                    <h2 class="fs-20 fs-md-24 fw-700 mb-3 h-35px text-truncate">
                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset hov-text-primary" title="{{ $blog->title }}">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    <div class="row">
                        <div class="col-4">
                            <!-- Date -->
                            <div>
                                <small class="fs-12 fw-400 opacity-60">{{ date('M d, Y',strtotime($blog->created_at)) }}</small>
                            </div>
                            <!-- Caregory -->
                            @if($blog->category != null)
                                <div>
                                    <small class="fs-12 fw-400 text-blue">{{ $blog->category->category_name }}</small>
                                </div>
                            @endif
                        </div>
                        <!-- Share -->
                        <div class="col-8 text-right">
                            <div class="aiz-share"></div>
                        </div>
                    </div>
                    <!-- Image -->
                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                        data-src="{{ uploaded_asset($blog->banner) }}"
                        alt="{{ $blog->title }}"
                        class="img-fluid lazyload w-100 mt-3 mb-4">
                    <!-- Description -->
                    <div class="mb-4 overflow-hidden">
                        {!! $blog->description !!}
                    </div>
                    <!-- Facebook Comment -->
                    @if (get_setting('facebook_comment') == 1)
                    <div class="mb-4">
                        <div class="fb-comments" data-href="{{ route("blog",$blog->slug) }}" data-width="" data-numposts="5"></div>
                    </div>
                    @endif
                </div>
            </div>

            
            <!-- recent posts -->
            <div class="col-xl-3 col-lg-4">
                <div class="p-3 border">
                    <h3 class="fs-16 fw-700 text-dark mb-3">{{ translate('Recent Posts') }}</h3>
                    <div class="row">
                        @foreach($recent_blogs as $recent_blog)
                        <div class="col-lg-12 col-sm-6 mb-4 hov-scale-img">
                            <div class="row">
                                <div class="col-4">
                                    <!-- Image -->
                                    <a href="{{ url("blog").'/'. $recent_blog->slug }}" class="text-reset d-block overflow-hidden size-90px mr-2">
                                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                            data-src="{{ uploaded_asset($recent_blog->banner) }}"
                                            alt="{{ $recent_blog->title }}"
                                            class="img-fit lazyload h-100 has-transition">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <!-- Title -->
                                    <h2 class="fs-14 fw-700 mb-3 h-35px text-truncate-2">
                                        <a href="{{ url("blog").'/'. $recent_blog->slug }}" class="text-reset hov-text-primary" title="{{ $recent_blog->title }}">
                                            {{ $recent_blog->title }}
                                        </a>
                                    </h2>
                                    <!-- Date -->
                                    <div>
                                        <small class="fs-12 fw-400 opacity-60">{{ date('M d, Y',strtotime($recent_blog->created_at)) }}</small>
                                    </div>
                                    <!-- Category -->
                                    @if($recent_blog->category != null)
                                        <div>
                                            <small class="fs-12 fw-400 text-blue">{{ $recent_blog->category->category_name }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection