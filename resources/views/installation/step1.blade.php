@extends('backend.layouts.blank')
@section('content')
    <div class="container pt-5">
        <div class="d-flex justify-content-center mt-5">
            <div class="card install-card position-relative">
                <!-- Content -->
                <div class="card-body install-card-body h-100 w-100 z-3 position-relative">
                    <!-- Top content -->
                    <div class="mar-ver pad-btm text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">
                            <g id="Group_22064" data-name="Group 22064" transform="translate(-937 -168)">
                              <path id="Path_25672" data-name="Path 25672" d="M28,0A28,28,0,1,1,0,28,28,28,0,0,1,28,0Z" transform="translate(941 172)" fill="#313131"/>
                              <g id="Group_2" data-name="Group 2" transform="translate(1155 168)">
                                <rect id="Rectangle_2" data-name="Rectangle 2" width="30" height="30" transform="translate(-201 15)" fill="none"/>
                                <g id="Group_1" data-name="Group 1" transform="translate(-271.443 -41.063)">
                                  <g id="LWPOLYLINE" transform="translate(80.353 59.063)">
                                    <path id="Path_3040" data-name="Path 3040" d="M85.339,67.256a.26.26,0,0,0,.288.382,4.5,4.5,0,0,1,5.046,2.232L94.1,75.809a.779.779,0,0,0,.9.355,4.18,4.18,0,0,0,2.951-4.192,1.3,1.3,0,0,0-.173-.589L90.82,59.323a.519.519,0,0,0-.9,0Z" transform="translate(-85.305 -59.063)" fill="#34a853"/>
                                  </g>
                                  <g id="LWPOLYLINE-2" data-name="LWPOLYLINE" transform="translate(71.643 69.117)">
                                    <path id="Path_3041" data-name="Path 3041" d="M81.325,88.78a.26.26,0,0,0,.187-.44,4.5,4.5,0,0,1-.59-5.486l3.428-5.938a.78.78,0,0,0-.144-.96A4.179,4.179,0,0,0,79.1,75.5a1.292,1.292,0,0,0-.424.443L71.713,88a.52.52,0,0,0,.45.78Z" transform="translate(-71.644 -74.835)" fill="#377dff"/>
                                  </g>
                                  <g id="LWPOLYLINE-3" data-name="LWPOLYLINE" transform="translate(81.891 74.219)">
                                    <path id="Path_3042" data-name="Path 3042" d="M100.375,82.963a.26.26,0,0,0-.475.058,4.5,4.5,0,0,1-4.456,3.254H88.588a.78.78,0,0,0-.76.6,4.18,4.18,0,0,0,2.154,4.652,1.3,1.3,0,0,0,.6.145h13.926a.52.52,0,0,0,.45-.78Z" transform="translate(-87.721 -82.833)" fill="#ea4335"/>
                                  </g>
                                </g>
                              </g>
                              <g id="Path_25673" data-name="Path 25673" transform="translate(937 168)" fill="none">
                                <path d="M32,0A32,32,0,1,1,0,32,32,32,0,0,1,32,0Z" stroke="none"/>
                                <path d="M 32 1 C 27.81459045410156 1 23.75490188598633 1.819499969482422 19.93370819091797 3.435718536376953 C 16.24237060546875 4.997028350830078 12.92699813842773 7.232379913330078 10.07968902587891 10.07968902587891 C 7.232379913330078 12.92699813842773 4.997028350830078 16.24237060546875 3.435718536376953 19.93370819091797 C 1.819499969482422 23.75490188598633 1 27.81459045410156 1 32 C 1 36.18541717529297 1.819499969482422 40.24510192871094 3.435718536376953 44.06629943847656 C 4.997028350830078 47.75762939453125 7.232379913330078 51.072998046875 10.07968902587891 53.92031097412109 C 12.92699813842773 56.76762008666992 16.24237060546875 59.00297164916992 19.93370819091797 60.56428146362305 C 23.75490188598633 62.18050003051758 27.81459045410156 63 32 63 C 36.18541717529297 63 40.24510192871094 62.18050003051758 44.06629943847656 60.56428146362305 C 47.75762939453125 59.00297164916992 51.0730094909668 56.76762008666992 53.92031097412109 53.92031097412109 C 56.76762008666992 51.0730094909668 59.00297164916992 47.75762939453125 60.56428146362305 44.06629943847656 C 62.18050003051758 40.24510192871094 63 36.18541717529297 63 32 C 63 27.81459045410156 62.18050003051758 23.75490188598633 60.56428146362305 19.93370819091797 C 59.00297164916992 16.24237060546875 56.76762008666992 12.92699813842773 53.92031097412109 10.07968902587891 C 51.072998046875 7.232379913330078 47.75762939453125 4.997028350830078 44.06629943847656 3.435718536376953 C 40.24510192871094 1.819499969482422 36.18541717529297 1 32 1 M 32 0 C 49.67311859130859 0 64 14.32688903808594 64 32 C 64 49.67311859130859 49.67311859130859 64 32 64 C 14.32688903808594 64 0 49.67311859130859 0 32 C 0 14.32688903808594 14.32688903808594 0 32 0 Z" stroke="none" fill="#e6e6e6"/>
                              </g>
                            </g>
                        </svg>
                        <h1 class="fs-21 fw-700 text-uppercase mt-2" style="color: #3d3d3d;">CHECKING FILE PERMISSIONS</h1>
                        <p class="fs-12 fw-500" style="color:  #666; line-height: 18px;">
                            We ran diagnosis on your server. Review the items that have a <span style="color: #fe2b25">red</span> mark on it. <br> If everything is green, you are good to go to the next step.
                        </p>
                    </div>

                    <ul class="list-group rounded-2">
                        <li class="list-group-item fs-12 fw-600 d-flex align-items-center justify-content-between" style="line-height: 18px; color: #666; gap: 7px;">
                            Php version 7.4

                            @php
                                $phpVersion = number_format((float)phpversion(), 2, '.', '');
                            @endphp
                            @if ($phpVersion >= 7.20)
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#fe2b25"/>
                                </svg>
                            @endif
                        </li>
                        <li class="list-group-item fs-12 fw-600 d-flex align-items-center justify-content-between" style="line-height: 18px; color: #666; gap: 7px;">
                            Curl Enabled

                            @if ($permission['curl_enabled'])
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#fe2b25"/>
                                </svg>
                            @endif
                        </li>
                        <li class="list-group-item fs-12 fw-600 d-flex align-items-center justify-content-between" style="line-height: 18px; color: #666; gap: 7px;">
                            .env File Permission

                            @if ($permission['db_file_write_perm'])
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#fe2b25"/>
                                </svg>
                            @endif
                        </li>
                        <li class="list-group-item fs-12 fw-600 d-flex align-items-center justify-content-between" style="line-height: 18px; color: #666; gap: 7px;">
                            RouteServiceProvider.php File Permission

                            @if ($permission['routes_file_write_perm'])
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#00ac47"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="13.435" height="13.435" viewBox="0 0 13.435 13.435">
                                    <path id="Union_2" data-name="Union 2" d="M-4076.25,7a.75.75,0,0,1-.75-.75V.75a.75.75,0,0,1,.75-.75.75.75,0,0,1,.75.75V5.5h9.75a.75.75,0,0,1,.75.75.75.75,0,0,1-.75.75Z" transform="translate(2882.875 -2874.389) rotate(-45)" fill="#fe2b25"/>
                                </svg>
                            @endif
                        </li>
                    </ul>

                    <p class="mb-4 pb-4 absolute-bottom-left right-0 d-flex justify-content-center">
                        <a href="{{ url('/') }}" class="back-btn-svg mr-3" title="Go Back" style="box-shadow: 0px 8px 16px rgb(255 88 0 / 16%); border-radius: 50%;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                <g id="Group_22706" data-name="Group 22706" transform="translate(-770 -653)">
                                  <g id="Ellipse_26" data-name="Ellipse 26" transform="translate(770 653)" fill="none" stroke="#cccccc" stroke-width="1">
                                    <circle cx="20" cy="20" r="20" stroke="none"/>
                                    <circle class="inner" cx="20" cy="20" r="19.5" fill="none"/>
                                  </g>
                                  <path id="e078aa9915b23dfe83446121b09a6213" class="arrow" d="M98.073,90.719H88.146l4.576-4.576L91.537,85,85,91.537l6.537,6.537,1.144-1.144-4.535-4.576h9.927Z" transform="translate(698.463 581.463)" fill="#cccccc"/>
                                </g>
                            </svg>
                        </a>
                        @if ($permission['curl_enabled'] == 1 && $permission['db_file_write_perm'] == 1 && $permission['routes_file_write_perm'] == 1 && $phpVersion >= 7.20)
                            @if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1')
                                <a href = "{{ route('step3') }}" class="btn btn-install text-uppercase">Go To Next Step</a>
                            @else
                                <a href = "{{ route('step2') }}" class="btn btn-install text-uppercase">Go To Next Step</a>
                            @endif
                        @endif
                    </p>
                </div>

                <!-- Common file -->
                @include('installation.common')

            </div>
        </div>
    </div>
@endsection
