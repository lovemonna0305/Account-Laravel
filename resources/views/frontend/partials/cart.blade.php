@php
    if (auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Models\Cart::where('user_id', $user_id)->get();
    } else {
        $temp_user_id = Session()->get('temp_user_id');
        if ($temp_user_id) {
            $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
        }
    }

    $total = 0;
    if(isset($cart) && count($cart) > 0){
        foreach ($cart as $key => $cartItem){
            $product = \App\Models\Product::find($cartItem['product_id']);
            $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
        }
    }
@endphp
<!-- Cart button with cart count -->
<a href="javascript:void(0)" class="d-flex align-items-center text-dark px-3 h-100" data-toggle="dropdown" data-display="static" title="{{translate('Cart')}}">
    <span class="mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20.562" viewBox="0 0 24 20.562">
            <g id="_5e67fc94b53aaec8ca181b806dd815ee" data-name="5e67fc94b53aaec8ca181b806dd815ee" transform="translate(-33.276 -101)">
              <path id="Path_32659" data-name="Path 32659" d="M34.034,102.519H38.2l-.732-.557c.122.37.243.739.365,1.112q.441,1.333.879,2.666.528,1.6,1.058,3.211.46,1.394.917,2.788c.149.451.291.9.446,1.352l.008.02a.76.76,0,0,0,1.466-.4c-.122-.37-.243-.739-.365-1.112q-.441-1.333-.879-2.666-.528-1.607-1.058-3.213-.46-1.394-.917-2.788c-.149-.451-.289-.9-.446-1.352l-.008-.02a.783.783,0,0,0-.732-.557H34.037a.76.76,0,0,0,0,1.519Z" fill="#fff"/>
              <path id="Path_32660" data-name="Path 32660" d="M288.931,541.934q-.615,1.1-1.233,2.193c-.058.106-.119.21-.177.317a.767.767,0,0,0,.656,1.142h11.6c.534,0,1.071.01,1.608,0h.023a.76.76,0,0,0,0-1.519h-11.6c-.534,0-1.074-.015-1.608,0h-.023l.656,1.142q.615-1.1,1.233-2.193c.058-.106.119-.21.177-.316a.759.759,0,0,0-1.312-.765Z" transform="translate(-247.711 -429.41)" fill="#fff"/>
              <circle id="Ellipse_553" data-name="Ellipse 553" cx="1.724" cy="1.724" r="1.724" transform="translate(49.612 117.606)" fill="#fff"/>
              <path id="Path_32661" data-name="Path 32661" d="M658.4,739.2a2.267,2.267,0,0,0,1.489,2.1,2.232,2.232,0,0,0,2.433-.648A2.231,2.231,0,1,0,658.4,739.2a.506.506,0,0,0,1.013,0c0-.041,0-.084.005-.124a.381.381,0,0,1,.005-.053c.008-.1,0,.033-.005.03a.979.979,0,0,1,.061-.248c.008-.02.023-.106.04-.111s-.046.094-.018.043a.656.656,0,0,0,.028-.061,2.3,2.3,0,0,1,.129-.215c.048-.073-.068.078.013-.015.025-.028.051-.058.078-.086s.056-.056.084-.081l.038-.033c.018-.015.091-.051.025-.023s-.015.013,0,0,.035-.025.056-.038a.947.947,0,0,1,.086-.051c.038-.023.078-.041.119-.061.013-.008.066-.033,0,0s.025-.008.033-.01A1.56,1.56,0,0,1,660.4,738l.068-.013c.056-.013-.048.005-.048.005.046,0,.094-.01.139-.01a2.043,2.043,0,0,1,.248.008c.094.008-.1-.018.02.005.046.008.089.02.134.03s.076.023.114.035a.589.589,0,0,1,.063.023c0,.008-.094-.048-.043-.018.071.043.149.076.22.122.018.013.035.025.056.038s.056.023,0,0-.018-.015,0,0l.051.043a2.274,2.274,0,0,1,.172.177c.076.084-.035-.058.013.015.02.033.043.063.063.1s.041.068.058.1l.023.046c.048.091.01-.008,0-.013.03.01.063.192.073.225l.023.1c.02.1,0-.03,0-.033.013.013.008.071.008.086a1.749,1.749,0,0,1,0,.23.63.63,0,0,0-.005.071c0,.051-.03.043.005-.03a.791.791,0,0,0-.028.134c-.018.071-.046.139-.066.21s.046-.086.013-.028a.245.245,0,0,0-.02.046c-.02.041-.041.078-.063.117s-.041.066-.063.1c-.068.1.048-.051-.01.018a1.932,1.932,0,0,1-.172.18c-.01.01-.071.076-.089.076,0,0,.1-.071.023-.02-.015.01-.028.018-.041.028-.071.046-.144.084-.218.122s.091-.03-.018.008l-.111.038-.116.03c-.018,0-.033.008-.051.01-.111.025.081-.005.015,0a2.045,2.045,0,0,1-.248.01c-.041,0-.081-.005-.124-.008-.015,0-.076-.008,0,0s-.018-.005-.035-.008a1.912,1.912,0,0,1-.261-.076c-.015-.005-.066-.03,0,0s-.015-.008-.03-.015c-.041-.02-.078-.041-.117-.063s-.073-.048-.111-.073c-.061-.038.008.02.023.02-.01,0-.043-.035-.051-.043a1.872,1.872,0,0,1-.187-.187.3.3,0,0,1-.043-.051c0,.01.061.086.02.023-.025-.038-.051-.073-.073-.111s-.048-.089-.071-.132c-.053-.1.025.081-.015-.033a1.836,1.836,0,0,1-.073-.263.163.163,0,0,0-.01-.051c.038.084.008.071,0,.013s-.008-.106-.008-.16a.513.513,0,0,0-1.026,0Z" transform="translate(-609.293 -619.872)" fill="#fff"/>
              <circle id="Ellipse_554" data-name="Ellipse 554" cx="1.724" cy="1.724" r="1.724" transform="translate(40.884 117.606)" fill="#fff"/>
              <path id="Path_32662" data-name="Path 32662" d="M270.814,272.355a2.267,2.267,0,0,0,1.489,2.1,2.232,2.232,0,0,0,2.433-.648,2.231,2.231,0,1,0-3.922-1.453.506.506,0,0,0,1.013,0c0-.041,0-.084.005-.124a.377.377,0,0,1,.005-.053c.008-.1,0,.033-.005.03a.981.981,0,0,1,.061-.248c.008-.02.023-.106.04-.111s-.046.094-.018.043a.656.656,0,0,0,.028-.061,2.3,2.3,0,0,1,.129-.215c.048-.073-.068.079.013-.015.025-.028.051-.058.078-.086s.056-.056.084-.081l.038-.033c.018-.015.091-.051.025-.023s-.015.013,0,0,.035-.025.056-.038a.96.96,0,0,1,.086-.051c.038-.023.078-.04.119-.061.013-.008.066-.033,0,0s.025-.008.033-.01a1.564,1.564,0,0,1,.213-.061l.068-.013c.056-.013-.048.005-.048.005.046,0,.094-.01.139-.01a2.031,2.031,0,0,1,.248.008c.094.008-.1-.018.02.005.046.008.089.02.134.03s.076.023.114.035a.583.583,0,0,1,.063.023c0,.008-.094-.048-.043-.018.071.043.149.076.22.122.018.013.035.025.056.038s.056.023,0,0-.018-.015,0,0l.051.043a2.257,2.257,0,0,1,.172.177c.076.084-.035-.058.013.015.02.033.043.063.063.1s.04.068.058.1l.023.046c.048.091.01-.008,0-.013.03.01.063.192.073.225l.023.1c.02.1,0-.03,0-.033.013.013.008.071.008.086a1.749,1.749,0,0,1,0,.23.622.622,0,0,0-.005.071c0,.051-.03.043.005-.03a.788.788,0,0,0-.028.134c-.018.071-.046.139-.066.21s.046-.086.013-.028a.249.249,0,0,0-.02.046c-.02.04-.041.078-.063.116s-.041.066-.063.1c-.068.1.048-.051-.01.018a1.929,1.929,0,0,1-.172.18c-.01.01-.071.076-.089.076,0,0,.1-.071.023-.02-.015.01-.028.018-.041.028-.071.046-.144.084-.218.122s.091-.03-.018.008l-.111.038-.116.03c-.018,0-.033.008-.051.01-.111.025.081-.005.015,0a2.039,2.039,0,0,1-.248.01c-.041,0-.081-.005-.124-.008-.015,0-.076-.008,0,0s-.018-.005-.035-.008a1.919,1.919,0,0,1-.261-.076c-.015-.005-.066-.03,0,0s-.015-.008-.03-.015c-.04-.02-.078-.04-.116-.063s-.073-.048-.111-.073c-.061-.038.008.02.023.02-.01,0-.043-.035-.051-.043a1.873,1.873,0,0,1-.187-.187.3.3,0,0,1-.043-.051c0,.01.061.086.02.023-.025-.038-.051-.073-.073-.111s-.048-.089-.071-.132c-.053-.1.025.081-.015-.033a1.84,1.84,0,0,1-.073-.263.164.164,0,0,0-.01-.051c.038.084.008.071,0,.013s-.008-.106-.008-.16a.513.513,0,0,0-1.026,0ZM287.2,258l-3.074,7.926H272.313L269.7,258Z" transform="translate(-230.437 -153.024)" fill="#fff"/>
              <path id="Path_32663" data-name="Path 32663" d="M267.044,237.988q-.52,1.341-1.038,2.682-.828,2.138-1.654,4.274l-.38.983.489-.372H254.1c-.476,0-.957-.02-1.436,0h-.02l.489.372q-.444-1.348-.886-2.694-.7-2.131-1.4-4.264c-.109-.327-.215-.653-.324-.983l-.489.641h16.791c.228,0,.456.005.681,0h.03a.506.506,0,0,0,0-1.013H250.744c-.228,0-.456-.005-.681,0h-.03a.511.511,0,0,0-.489.641q.444,1.348.886,2.694.7,2.131,1.4,4.264c.109.327.215.653.324.983a.523.523,0,0,0,.489.372h10.359c.476,0,.957.018,1.436,0h.02a.526.526,0,0,0,.489-.372q.52-1.341,1.038-2.682.828-2.138,1.654-4.274l.38-.983a.508.508,0,0,0-.355-.623A.52.52,0,0,0,267.044,237.988Z" transform="translate(-210.769 -133.152)" fill="#fff"/>
            </g>
        </svg>
    </span>
    <span class="d-none d-xl-block ml-2 fs-14 fw-700 text-white">{{ single_price($total) }}</span>
    <span class="nav-box-text d-none d-xl-block ml-2 text-white fs-12">
        (<span class="cart-count">{{(isset($cart) && count($cart) > 0) ? count($cart) : 0 }}</span> {{translate('Items')}})
    </span>
</a>

<!-- Cart Items -->
<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation rounded-0">
    @if (isset($cart) && count($cart) > 0)
        <div class="fs-16 fw-700 text-soft-dark pt-4 pb-2 mx-4 border-bottom" style="border-color: #e5e5e5 !important;">
            {{ translate('Cart Items') }}
        </div>
        <!-- Cart Products -->
        <ul class="h-360px overflow-auto c-scrollbar-light list-group list-group-flush mx-1">
            @foreach ($cart as $key => $cartItem)
                @php
                    $product = \App\Models\Product::find($cartItem['product_id']);
                @endphp
                @if ($product != null)
                    <li class="list-group-item border-0 hov-scale-img">
                        <span class="d-flex align-items-center">
                            <a href="{{ route('product', $product->slug) }}"
                                class="text-reset d-flex align-items-center flex-grow-1">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    class="img-fit lazyload size-60px has-transition"
                                    alt="{{ $product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                <span class="minw-0 pl-2 flex-grow-1">
                                    <span class="fw-700 fs-13 text-dark mb-2 text-truncate-2" title="{{ $product->getTranslation('name') }}">
                                        {{ $product->getTranslation('name') }}
                                    </span>
                                    <span class="fs-14 fw-400 text-secondary">{{ $cartItem['quantity'] }}x</span>
                                    <span class="fs-14 fw-400 text-secondary">{{ cart_product_price($cartItem, $product) }}</span>
                                </span>
                            </a>
                            <span class="">
                                <button onclick="removeFromCart({{ $cartItem['id'] }})"
                                    class="btn btn-sm btn-icon stop-propagation">
                                    <i class="la la-close fs-18 fw-600 text-secondary"></i>
                                </button>
                            </span>
                        </span>
                    </li>
                @endif
            @endforeach
        </ul>
        <!-- Subtotal -->
        <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between mx-4" style="border-color: #e5e5e5 !important;">
            <span class="fs-14 fw-400 text-secondary">{{ translate('Subtotal') }}</span>
            <span class="fs-16 fw-700 text-dark">{{ single_price($total) }}</span>
        </div>
        <!-- View cart & Checkout Buttons -->
        <div class="py-3 text-center border-top mx-4" style="border-color: #e5e5e5 !important;">
            <div class="row gutters-10 justify-content-center">
                <div class="col-sm-6 mb-2">
                    <a href="{{ route('cart') }}" class="btn btn-warning btn-sm btn-block rounded-4 text-white">
                        {{ translate('View cart') }}
                    </a>
                </div>
                @if (Auth::check())
                <div class="col-sm-6">
                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-sm btn-block rounded-4">
                        {{ translate('Checkout') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{ translate('Your Cart is empty') }}</h3>
        </div>
    @endif
</div>
