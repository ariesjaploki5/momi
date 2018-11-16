@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h4 class="mt-1 mb-0 text-center">Register</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="email" type="text" 
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="email" value="{{ old('email') }}" placeholder="*Email" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="password" type="password" 
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="password" value="{{ old('password') }}" placeholder="*Password" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                                <input id="password-confirm" type="password" class="form-control form-control-sm" 
                                                name="password_confirmation" placeholder="*Confirm Password" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="firstname" type="text"
                                            class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="firstname" value="{{ old('firstname') }}" placeholder="*Firstname" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('firstname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="lastname" type="text"
                                            class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="lastname" value="{{ old('lastname') }}" placeholder="*Lastname" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="middlename" type="text" pattern="[a-zA-Z]{1,}"
                                            class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="middlename" value="{{ old('middlename') }}" placeholder="*Middlename" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('middlename'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('middlename') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="birthdate" type="date"
                                            class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }} form-control-sm text-uppercase" 
                                            name="birthdate" value="{{ old('birthdate') }}" placeholder="*Birthdate" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fas fa-birthday-cake"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('birthdate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birthdate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="contact" type="text"
                                            class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="contact" value="{{ old('contact') }}" placeholder="*Contact" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fas fa-mobile-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('contact'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contact') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="address" type="text"
                                            class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="address" value="{{ old('address') }}" placeholder="*Address" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fa fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-1">
                                            <input id="city" type="text"
                                            class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }} form-control-sm" 
                                            name="city" value="{{ old('city') }}" placeholder="*City" required>
                                            <div class="input-group-append">
                                                <div class=" input-group-text bg-white">
                                                    <span class="fas fa-city"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row  text-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        I already have an account
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
