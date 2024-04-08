@extends('backend.layouts.app')
@section('content')
<div class="">
    <form class="form form-horizontal mar-top" action="{{route('customer_register')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        <div class="row gutters-5">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Basic information')}}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control mb-3 {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Email or Phone -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control mb-3 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Address')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3">

                            <!-- Address -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Address')}}</label>
                                <div class="col-md-8">
                                    <textarea class="form-control mb-3 {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" placeholder="{{ translate('Your Address')}}" rows="2" name="address"></textarea>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <!-- Country -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Country')}}</label>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <select class="form-control aiz-selectpicker {{ $errors->has('country_id') ? ' is-invalid' : '' }}" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id">
                                            <option value="">{{ translate('Select your country') }}</option>
                                            @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <!-- State -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('State')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control mb-3 aiz-selectpicker {{ $errors->has('state_id') ? ' is-invalid' : '' }}" data-live-search="true" name="state_id">
    
                                    </select>
                                    @if ($errors->has('state_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <!-- City -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('City')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control mb-3 aiz-selectpicker {{ $errors->has('city_id') ? ' is-invalid' : '' }}" data-live-search="true" name="city_id">
    
                                    </select>
                                    @if ($errors->has('city_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Postal code -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Postal code')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control mb-3 {{ $errors->has('postal_code') ? ' is-invalid' : '' }}" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="{{ old('postal_code') }}">
                                    @if ($errors->has('postal_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <!-- Phone -->
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('Phone')}}</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control mb-3 {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ translate('+880')}}" name="phone" value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="Third group">
                    <button id="cancel" name="button" value="unpublish" class="btn btn-primary action-btn">{{ translate('Cancel') }}</button>
                </div>
                <div class="btn-group" role="group" aria-label="Second group">
                    <button type="submit" name="button" value="publish" class="btn btn-success action-btn">{{ translate('Save') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
// $("cancel").on('click', function(){
//     $("#choice_form").reset();
// });


    function add_new_address(){
        $('#new-address-modal').modal('show');
    }

    function edit_address(address) {
        var url = '{{ route("addresses.edit", ":id") }}';
        url = url.replace(':id', address);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit_modal_body').html(response.html);
                $('#edit-address-modal').modal('show');
                AIZ.plugins.bootstrapSelect('refresh');

                @if (get_setting('google_map') == 1)
                    var lat     = -33.8688;
                    var long    = 151.2195;

                    if(response.data.address_data.latitude && response.data.address_data.longitude) {
                        lat     = parseFloat(response.data.address_data.latitude);
                        long    = parseFloat(response.data.address_data.longitude);
                    }

                    initialize(lat, long, 'edit_');
                @endif
            }
        });
    }
    
    $(document).on('change', '[name=country_id]', function() {
        var country_id = $(this).val();
        get_states(country_id);
    });

    $(document).on('change', '[name=state_id]', function() {
        var state_id = $(this).val();
        get_city(state_id);
    });
    
    function get_states(country_id) {
        $('[name="state"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-state')}}",
            type: 'POST',
            data: {
                country_id  : country_id
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="state_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }

    function get_city(state_id) {
        $('[name="city"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                state_id: state_id
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="city_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
</script>
@endsection