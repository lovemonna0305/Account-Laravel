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
                        <h1 class="fs-21 fw-700 text-uppercase mt-2" style="color: #3d3d3d;">Purchase Code</h1>
                        <p class="fs-12 fw-500" style="color:  #666; line-height: 18px;">
                            Provide your codecanyon purchase code.<br>
                            <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank" class="text-blue hov-text-primary"><i>Where to get purchase code?</i></a>
                        </p>
                    </div>

                    <form method="POST" action="{{ route('update.code') }}">
                        @csrf
                        <div class="form-group">
                            <label for="purchase_code" class="fs-12 fw-500" style="color: #666;">Purchase Code</label>
                            <input type="text" class="form-control rounded-2 border" style="height: 36px !important;" id="purchase_code" name="purchase_code" placeholder="**** **** **** ****" required="">
                        </div>
                        <div class="text-center mt-5 pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="110" height="90" viewBox="0 0 110 90">
                                <defs>
                                  <clipPath id="clip-path">
                                    <rect id="Rectangle_19104" data-name="Rectangle 19104" width="110" height="90" transform="translate(1517 718)" fill="none" stroke="#707070" stroke-width="1"/>
                                  </clipPath>
                                </defs>
                                <g id="Mask_Group_37" data-name="Mask Group 37" transform="translate(-1517 -718)" clip-path="url(#clip-path)">
                                  <g id="Group_22695" data-name="Group 22695">
                                    <path id="Subtraction_9" data-name="Subtraction 9" d="M-10247,88h-42V86h42a6.007,6.007,0,0,0,6-6V48a6.009,6.009,0,0,0-6-6h-48a6.009,6.009,0,0,0-6,6v6h-2V48a8.01,8.01,0,0,1,8-8h2V22a21.884,21.884,0,0,1,1.728-8.562,21.923,21.923,0,0,1,4.717-6.992,21.861,21.861,0,0,1,6.992-4.714A21.851,21.851,0,0,1-10271,0a21.859,21.859,0,0,1,8.565,1.73,21.862,21.862,0,0,1,6.992,4.714,21.96,21.96,0,0,1,4.717,6.992A21.884,21.884,0,0,1-10249,22V40h2a8.01,8.01,0,0,1,8,8V80A8.01,8.01,0,0,1-10247,88Zm-24-86a19.867,19.867,0,0,0-7.783,1.572,19.911,19.911,0,0,0-6.356,4.285,19.9,19.9,0,0,0-4.287,6.359A19.873,19.873,0,0,0-10291,22V40h40V22a19.889,19.889,0,0,0-1.572-7.784,19.932,19.932,0,0,0-4.287-6.359,19.873,19.873,0,0,0-6.356-4.285A19.883,19.883,0,0,0-10271,2Zm0,72a1,1,0,0,1-1-1V65.916a6.016,6.016,0,0,1-3.563-2.025A6,6,0,0,1-10277,60a6.006,6.006,0,0,1,6-6,6.006,6.006,0,0,1,6,6,5.994,5.994,0,0,1-1.437,3.891,6.011,6.011,0,0,1-3.562,2.025V73A1,1,0,0,1-10271,74Zm0-18a4,4,0,0,0-4,4,4,4,0,0,0,4,4,4.005,4.005,0,0,0,4-4A4.005,4.005,0,0,0-10271,56Z" transform="translate(11865 719)" fill="#e6e6e6"/>
                                    <path id="Union_12" data-name="Union 12" d="M15,87V31.97A16,16,0,0,1,0,16,16,16,0,0,1,27.313,4.686a16,16,0,0,1,0,22.628A15.879,15.879,0,0,1,17,31.97V68h9a1,1,0,1,1,0,2H17v8h9a1,1,0,1,1,0,2H17v7a1,1,0,0,1-2,0ZM6.1,6.1A14,14,0,0,0,15.962,30h.076A14,14,0,0,0,25.9,6.1a14,14,0,0,0-19.8,0Z" transform="translate(1580.712 797.001) rotate(150)" fill="#fe2b25"/>
                                  </g>
                                </g>
                            </svg>
                        </div>
                        <div class="mb-4 pb-4 absolute-bottom-left right-0 d-flex justify-content-center">
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
                          <button type="submit" class="btn btn-install text-uppercase">Update</button>
                        </div>
                    </form>
                </div>

                <!-- Common file -->
                @include('update.common')
                
            </div>
        </div>
    </div>
@endsection
