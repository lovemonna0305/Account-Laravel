<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL')}}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
  	<title>{{ config('app.name', 'eCommerce') }}</title>

    <!-- google font -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .install-card{
            width: 640px;
            height: 640px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid #e6e6e6;
            box-shadow: 0px 16px 45px rgba(0, 0, 0, 0.08);
        }
        .install-card .install-card-body{
            padding: 3rem 4rem !important;
        }
        .btn-install{
            width: 280px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 20px;
            background: linear-gradient(to right, #e90608 0%, #f59e39 100%);
            box-shadow: 0px 8px 16px rgba(255, 88, 0, 0.16);
            font-weight: bold;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            color: #fff !important;
            transition: all 0.5s;
        }
        .btn-install:hover{
            box-shadow: 0px 8px 40px rgb(255 88 0 / 30%);
            letter-spacing: 0.3px;
        }
        .back-btn-svg svg * {
            transition: fill .4s ease;
        }
        .back-btn-svg:hover svg .inner{
            fill: #cccccc !important;
        }
        .back-btn-svg:hover svg .arrow{
            fill: #fff !important;
        }
        .right-links{
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            padding: 0;
            vertical-align: middle;
            background: transparent;
            font-size: inherit;
            font-family: 'Roboto', sans-serif;
            width: 11rem;
            height: auto;
        }
        .right-links .circle {
            transition: all 0.8s cubic-bezier(0.65,0,.076,1);
            position: relative;
            display: flex;
            align-items: center;
            margin: 0;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 1.625rem;
            padding-left: 12px;
        }
        .right-links.site .circle {
            background: #007cff;
        }
        .right-links.video .circle {
            background: #ea4335;
        }
        .right-links.document .circle {
            background: #34a853;
        }
        .right-links.site:hover .circle {
            width: 100%;
        }
        .right-links.video:hover .circle {
            width: 8.5rem;
        }
        .right-links.document:hover .circle {
            width: 10.5rem;
        }
        .right-links .button-text {
            transition: all 0.5s cubic-bezier(0.65,0,.076,1);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.65rem 0;
            margin: 0 0 0 2.75rem;
            color: #f2f3f8;
            font-weight: 500;
            font-size: 12px;
            line-height: 18px;
            opacity: 0;
        }
        .right-links:hover .button-text {
            color: var(--white);
            opacity: 1;
        }
    </style>

    <script>
        var AIZ = AIZ || {};
    </script>
</head>
<body>
    <div class="aiz-main-wrapper d-flex">

        <div class="flex-grow-1">
            @yield('content')
        </div>

    </div><!-- .aiz-main-wrapper -->
    <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>

    @yield('script')

    <script type="text/javascript">
    @foreach (session('flash_notification', collect())->toArray() as $message)
        AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
    </script>
</body>
</html>
