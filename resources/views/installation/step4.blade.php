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
                        <h1 class="fs-21 fw-700 text-uppercase mt-2" style="color: #3d3d3d;">Import SQL</h1>
                        <p class="fs-12 fw-500" style="color:  #666; line-height: 18px;">
                            Your database is successfully connected. All you need to do now is hit the ‘Install’ Button. The auto installer will run a sql file, will do all the tiresome works and set up your application automatically.
                        </p>
                    </div>

                    <div class="mt-5 pt-5 text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="110.999" height="100" viewBox="0 0 110.999 100">
                        <g id="Group_22697" data-name="Group 22697" transform="translate(-485 -509)">
                          <path id="Union_13" data-name="Union 13" d="M-12298.562,74.272a21.97,21.97,0,0,1-7-4.712,22.025,22.025,0,0,1-4.715-7A21.872,21.872,0,0,1-12312,54a21.861,21.861,0,0,1,1.728-8.562,21.991,21.991,0,0,1,4.715-7,21.97,21.97,0,0,1,7-4.712,21.826,21.826,0,0,1,2.923-1,37.709,37.709,0,0,1,2.627-9.522,37.892,37.892,0,0,1,8.142-12.078,37.878,37.878,0,0,1,12.082-8.145A37.764,37.764,0,0,1-12258,0a37.775,37.775,0,0,1,14.791,2.985,37.9,37.9,0,0,1,12.082,8.145,37.958,37.958,0,0,1,7.789,11.27,26.775,26.775,0,0,1,5.847,1.723,26.919,26.919,0,0,1,8.584,5.784,26.832,26.832,0,0,1,5.784,8.584A26.8,26.8,0,0,1-12201,49a26.8,26.8,0,0,1-2.123,10.509,26.8,26.8,0,0,1-5.784,8.584,26.868,26.868,0,0,1-8.584,5.784A26.8,26.8,0,0,1-12228,76h-11a1,1,0,0,1-1-1,1,1,0,0,1,1-1h11.009a24.827,24.827,0,0,0,9.725-1.965,24.906,24.906,0,0,0,7.944-5.358,24.919,24.919,0,0,0,5.357-7.944A24.861,24.861,0,0,0-12203,49a24.835,24.835,0,0,0-1.965-9.73,24.884,24.884,0,0,0-5.357-7.947,24.957,24.957,0,0,0-7.944-5.358,24.791,24.791,0,0,0-4.93-1.5l-.958-.166q-.259-.04-.521-.075l0-.009,0-.007-.067-.012-.016-.043-.068-.161q-.4-.948-.853-1.867L-12228,22q1.163,0,2.31.1a35.893,35.893,0,0,0-6.852-9.552,35.9,35.9,0,0,0-11.442-7.715A35.83,35.83,0,0,0-12258,2a35.819,35.819,0,0,0-14.013,2.827,35.9,35.9,0,0,0-11.441,7.715,35.888,35.888,0,0,0-7.716,11.442,35.78,35.78,0,0,0-2.381,8.3l.011,0-.26,2.064.021.009-.042.008a.006.006,0,0,0,0,0l-1.71.4a19.521,19.521,0,0,0-2.254.8,19.91,19.91,0,0,0-6.356,4.286,19.923,19.923,0,0,0-4.285,6.356A19.846,19.846,0,0,0-12310,54a19.857,19.857,0,0,0,1.573,7.787,19.992,19.992,0,0,0,4.285,6.356,20.011,20.011,0,0,0,6.356,4.286,19.893,19.893,0,0,0,7.714,1.573l.072,0h16a1,1,0,0,1,1,1,1,1,0,0,1-1,1h-16v0A21.856,21.856,0,0,1-12298.562,74.272Z" transform="translate(12797 509)" fill="#e6e6e6"/>
                          <rect id="Rectangle_19108" data-name="Rectangle 19108" width="2" height="44" rx="1" transform="translate(539.5 564.374)" fill="#0e7cff"/>
                          <path id="Union_14" data-name="Union 14" d="M-12312,15V1a1,1,0,0,1,1-1h14a1,1,0,0,1,1,1,1,1,0,0,1-1,1h-13V15a1,1,0,0,1-1,1A1,1,0,0,1-12312,15Z" transform="translate(-8165.399 -8096.898) rotate(-135)" fill="#0e7cff"/>
                        </g>
                      </svg>
                    </div>

                    <div class="text-center mar-top pad-top">
                        <div id="loader" style="margin-top: 20px; display: none; transition: all 0.5s;">
                            <img loading="lazy"  src="{{ asset('loader.gif') }}" alt="" width="20">
                            &nbsp; Importing database ....
                        </div>
                    </div>
                    
                    <div class="mb-4 pb-4 absolute-bottom-left right-0 d-flex justify-content-center">
                      <a href="{{ route('step3') }}" class="back-btn-svg mr-3" title="Go Back" style="box-shadow: 0px 8px 16px rgb(255 88 0 / 16%); border-radius: 50%;">
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
                      <a href="{{ route('import_sql') }}" class="btn btn-install text-uppercase" onclick="showLoder()">Import SQL</a>
                    </div>
                </div>

                <!-- Common file -->
                @include('installation.common')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function showLoder() {
            $('#loader').fadeIn();
        }
    </script>
@endsection
