@extends('backend.layouts.app')

@section('content')
<div class="">
    <form class="form form-horizontal mar-top" action="" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        <div class="row gutters-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Personal Info')}}</h5>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{translate('Basic Info')}}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control mb-3 {{ $errors->has('shop_name') ? ' is-invalid' : '' }}" value="{{ old('shop_name') }}" placeholder="{{  translate('Shop Name') }}" name="shop_name">
                                @if ($errors->has('shop_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shop_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Email or Phone -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="address" class="form-control mb-3 {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" placeholder="{{  translate('Address') }}" name="address">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
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