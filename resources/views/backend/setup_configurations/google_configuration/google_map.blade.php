@extends('backend.layouts.app')
<style>
    #map {
        width: 100%;
        height: 250px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{ translate('Google Map Setting') }}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('google-map.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="control-label">{{ translate('Google Map') }}</label>
                            </div>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" name="google_map" type="checkbox"
                                        @if (get_setting('google_map') == 1) checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="types[]" value="MAP_API_KEY">
                            <div class="col-md-4">
                                <label class="control-label">{{ translate('Map API KEY') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="MAP_API_KEY"
                                    value="{{ env('MAP_API_KEY') }}" placeholder="{{ translate('Map API KEY') }}">
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6">{{ translate('Google Map Configuration Notes') }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">
                            1. {{ translate('Enable Google map ') }}
                        </li>
                        <li class="list-group-item text-dark">
                            2. {{ translate('Set the google map API key') }}.
                        </li>
                        <li class="list-group-item text-dark">
                            2. {{ translate('After then you will find the google map option to set default location') }}.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if (get_setting('google_map') == 1)            
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h6">{{ translate('Default Location Setting') }}</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf     
                                          
                            <div class="row">
                                <div id="map"></div>
                                <ul id="geoData">
                                    <li style="display: none;">Full Address: <span id="location"></span></li>
                                    <li style="display: none;">Postal Code: <span id="postal_code"></span></li>
                                    <li style="display: none;">Country: <span id="country"></span></li>
                                    <li style="display: none;">Latitude: <span id="lat"></span></li>
                                    <li style="display: none;">Longitude: <span id="lon"></span></li>
                                </ul>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">Longitude</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="hidden" name="types[]" value="google_map_longtitude">
                                    <input type="text" class="form-control mb-3" id="longitude" name="google_map_longtitude" value="{{ get_setting('google_map_longtitude') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">Latitude</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="hidden" name="types[]" value="google_map_latitude">
                                    <input type="text" class="form-control mb-3" id="latitude" name="google_map_latitude" value="{{ get_setting('google_map_latitude') }}" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{ translate('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
@endsection


@section('script')
    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
@endsection
