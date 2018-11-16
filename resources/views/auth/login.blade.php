@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-xs-10">
            <div class="card">
                
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mt-1 pb-1 text-center">Login</h4>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row px-2">
                            <div class="col-md-12">
                                
                                <div class="input-group mb-3">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
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
                        
                        <div class="form-group row px-2">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-md-4 mt-4">
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Recover Account?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
