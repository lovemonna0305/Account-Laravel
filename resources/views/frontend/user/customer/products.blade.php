@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fs-20 fw-700 text-dark">{{ translate('Classified Products') }}</h1>
        </div>
      </div>
    </div>

    <div class="row gutters-16 mb-2">
        <!-- Remaining Uploads -->
        <div class="col-md-4 mx-auto mb-4" >
            <div class="bg-dark text-white overflow-hidden text-center p-4 h-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <g id="Group_24953" data-name="Group 24953" transform="translate(-1364 -447)">
                      <g id="Group_24954" data-name="Group 24954">
                        <rect id="Rectangle_18897" data-name="Rectangle 18897" width="2" height="22" rx="1" transform="translate(1379 449)" fill="#fff"/>
                        <rect id="Rectangle_18899" data-name="Rectangle 18899" width="2" height="12" rx="1" transform="translate(1380 447) rotate(45)" fill="#fff"/>
                        <rect id="Rectangle_18900" data-name="Rectangle 18900" width="12" height="2" rx="1" transform="translate(1380 447) rotate(45)" fill="#fff"/>
                        <rect id="Rectangle_18898" data-name="Rectangle 18898" width="32" height="2" rx="1" transform="translate(1364 477)" fill="#fff"/>
                      </g>
                    </g>
                </svg>
                <div class="py-2">
                    <div class="fs-14 fw-400 text-center">{{  translate('Remaining Uploads') }}</div>
                    <div class="fs-30 fw-700 text-center">{{ max(0, Auth::user()->remaining_uploads) }}</div>
                </div>
            </div>
        </div>
        
        <!-- Add New Product -->
        <div class="col-md-4 mx-auto mb-4" >
            <a href="{{ route('customer_products.create')}}">
              <div class="p-4 mb-3 c-pointer text-center bg-light has-transition border h-100 hov-bg-soft-light">
                  <span class="size-60px rounded-circle mx-auto bg-dark d-flex align-items-center justify-content-center mb-3">
                      <i class="las la-plus la-3x text-white"></i>
                  </span>
                  <div class="fs-14 fw-600 text-dark">{{ translate('Add New Product') }}</div>
              </div>
            </a>
        </div>
        
        <!-- Current Package -->
        @php
            $customer_package = \App\Models\CustomerPackage::find(Auth::user()->customer_package_id);
        @endphp
        <div class="col-md-4 mx-auto mb-4">
            <div class="text-center bg-light d-block p-4 h-100 border">
                @if($customer_package != null)
                    <img src="{{ uploaded_asset($customer_package->logo) }}" height="44" class="mw-100 mx-auto mb-2">
                    <span class="d-block text-dark fs-14 fw-600 mb-2">{{ translate('Current Package')}}: {{ $customer_package->getTranslation('name') }}</span>
                @else
                    <i class="la la-frown-o mb-1 la-3x"></i>
                    <div class="d-block text-dark fs-14 fw-600 mb-2">{{ translate('No Package Found')}}</div>
                @endif
                <a href="{{ route('customer_packages_list_show') }}" class="text-primary hov-text-dark fs-14 fw-700">
                    {{ translate('Upgrade Package')}}
                    <i class="las la-angle-right fs-16 fw-900"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- All Products -->
    <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-md-0 fs-20 fw-700 text-dark text-center text-md-left">{{ translate('All Products') }}</h5>
        </div>
        <div class="card-body py-0">
            <table class="table aiz-table mb-0">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">#</th>
                        <th>{{ translate('Product')}}</th>
                        <th data-breakpoints="lg">{{ translate('Price')}}</th>
                        <th data-breakpoints="lg" class="w-120px">{{ translate('Available Status')}}</th>
                        <th data-breakpoints="lg">{{ translate('Admin Status')}}</th>
                        <th class="text-right pr-0 w-90px">{{ translate('Options')}}</th>
                    </tr>
                </thead>

                <tbody class="fs-14">
                    @foreach ($products as $key => $product)
                    <tr>
                        <td class="pl-0" style="vertical-align: middle;">{{ sprintf('%02d', $key+1) }}</td>
                        <td class="text-dark" style="vertical-align: middle;">
                            <a href="{{ route('customer.product', $product->slug) }}" class="text-reset hov-text-primary d-flex align-items-center">
                                <img class="lazyload img-fit size-70px"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    alt="{{  $product->getTranslation('name')  }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                <span class="ml-1">{{ $product->name }}</span>
                            </a>
                        </td>
                        <td class="fw-700" style="vertical-align: middle;">{{ single_price($product->unit_price) }}</td>
                        <td style="vertical-align: middle;">
                            <label class="aiz-switch aiz-switch-success mb-0">
                            <input onchange="update_status(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($product->published == '1')
                                <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('PUBLISHED')}}</span>
                            @else
                                <span class="badge badge-inline badge-info p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('PENDING')}}</span>
                            @endif
                        </td>
                        <td class="text-right pr-0" style="vertical-align: middle;">
                            <a class="btn btn-soft-warning btn-icon btn-circle btn-sm hov-svg-white" href="{{route('customer_products.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="12.001" viewBox="0 0 12 12.001">
                                    <defs>
                                    <clipPath id="clip-path">
                                        <rect id="Rectangle_18901" data-name="Rectangle 18901" width="10" height="10" transform="translate(0 0.049)" fill="#f3af3d"/>
                                    </clipPath>
                                    </defs>
                                    <g id="Group_25007" data-name="Group 25007" transform="translate(-1337 -418)">
                                    <g id="Group_24807" data-name="Group 24807" transform="translate(-4 -6.999)">
                                        <rect id="Rectangle_18661" data-name="Rectangle 18661" width="12" height="1" transform="translate(1341 436)" fill="#f3af3d"/>
                                    </g>
                                    <g id="Group_24957" data-name="Group 24957" transform="translate(1338 417.951)" clip-path="url(#clip-path)">
                                        <path id="Path_32605" data-name="Path 32605" d="M8.647,3.078l.893-.893a.632.632,0,0,1,.893,0l.893.893a.627.627,0,0,1,0,.89l-.9.888a.212.212,0,0,1-.3,0L8.647,3.376A.211.211,0,0,1,8.647,3.078Zm-.3.6L9.838,5.162a.211.211,0,0,1,0,.3L4.107,11.191a.37.37,0,0,1-.179.089L2.365,11.5a.3.3,0,0,1-.357-.357l.223-1.563A.369.369,0,0,1,2.321,9.4L8.052,3.673A.211.211,0,0,1,8.349,3.673Z" transform="translate(-1.686 -1.776)" fill="#f3af3d"/>
                                    </g>
                                    </g>
                                </svg>
						    </a>
                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm hov-svg-white confirm-delete" data-href="{{route('customer_products.destroy', $product->id)}}" title="{{ translate('Delete') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.202" height="12" viewBox="0 0 9.202 12">
                                    <path id="Path_28714" data-name="Path 28714" d="M15.041,7.608l-.193,5.85a1.927,1.927,0,0,1-1.933,1.864H9.243A1.927,1.927,0,0,1,7.31,13.46L7.117,7.608a.483.483,0,0,1,.966-.032l.193,5.851a.966.966,0,0,0,.966.929h3.672a.966.966,0,0,0,.966-.931l.193-5.849a.483.483,0,1,1,.966.032Zm.639-1.947a.483.483,0,0,1-.483.483H6.961a.483.483,0,1,1,0-.966h1.5a.617.617,0,0,0,.615-.555,1.445,1.445,0,0,1,1.442-1.3h1.126a1.445,1.445,0,0,1,1.442,1.3.617.617,0,0,0,.615.555h1.5a.483.483,0,0,1,.483.483ZM9.913,5.178h2.333a1.6,1.6,0,0,1-.123-.456.483.483,0,0,0-.48-.435H10.516a.483.483,0,0,0-.48.435,1.6,1.6,0,0,1-.124.456ZM10.4,12.5V8.385a.483.483,0,0,0-.966,0V12.5a.483.483,0,1,0,.966,0Zm2.326,0V8.385a.483.483,0,0,0-.966,0V12.5a.483.483,0,1,0,.966,0Z" transform="translate(-6.478 -3.322)" fill="#d43533"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="aiz-pagination">
                {{ $products->links() }}
          	</div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('customer_products.update.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status has been updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
