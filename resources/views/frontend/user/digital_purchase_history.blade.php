@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card shadow-none rounded-0 border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark">{{ translate('Download Your Products') }}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">{{ translate('Product')}}</th>
                        <th class="pr-0 text-right" width="20%">{{ translate('Option')}}</th>
                    </tr>
                </thead>
                <tbody class="fs-14">
                        @foreach ($orders as $key => $order_id)
                            @php
                                $order = \App\Models\OrderDetail::find($order_id->id);
                            @endphp
                            <tr>
                                <td class="pl-0">
                                    <a href="{{ route('product', $order->product->slug) }}" class="d-flex align-items-center">
                                        <img class="lazyload img-fit size-80px"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($order->product->thumbnail_img) }}"
                                            alt="{{  $order->product->getTranslation('name')  }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        <span class="ml-2">{{ $order->product->getTranslation('name') }}</span>
                                    </a>
                                </td>
                                <td class="pr-0 text-right" style="vertical-align: middle;">
                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm hov-svg-white" href="{{route('digital-products.download', encrypt($order->product->id))}}" title="{{ translate('Download') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12.001" viewBox="0 0 12 12.001">
                                            <g id="Group_24807" data-name="Group 24807" transform="translate(-1341 -424.999)">
                                              <path id="Union_17" data-name="Union 17" d="M13936.389,851.5l.707-.707,2.355,2.355V846h1v7.1l2.306-2.306.707.707-3.538,3.538Z" transform="translate(-12592.95 -421)" fill="#3490f3"/>
                                              <rect id="Rectangle_18661" data-name="Rectangle 18661" width="12" height="1" transform="translate(1341 436)" fill="#3490f3"/>
                                            </g>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
