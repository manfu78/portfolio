@extends('layouts.auth.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-6">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{-- <form method="POST" action="{{ route('login') }}"> --}}
                        <form name="form-login" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-5">
                                <div class="col">
                                    <span class="login100-form-title pb-0">
                                        Login
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}
                                <div class="col">
                                    {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}
                                    <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-email @error('email') text-danger @enderror" aria-hidden="true"></i>
                                        </a>
                                        <input type="email" id="email" name="email" class="input100 border-start-0 form-control ms-0" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                        <div class="">
                                            <span class="text-danger">
                                                <small>{{ $message }}</small>
                                            </span>
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                                <div class="col">
                                    {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> --}}
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye @error('password') text-danger @enderror" aria-hidden="true"></i>
                                        </a>
                                        <input type="password" name="password" id="password" class="input100 border-start-0 form-control ms-0" required autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <span class="text-danger">
                                            <span class="text-danger">
                                                <small>{{ $message }}</small>
                                            </span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary btn-blok">
                                        {{ __('Login') }}
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('patata')
    <div class="container">
        <div class="wrap-login100 p-6">
            <form class="login100-form validate-form">
                <span class="login100-form-title pb-0">
                    Login
                </span>
                <div class="panel panel-primary">

                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 border-start-0 form-control ms-0" type="email" placeholder="Email">
                        </div>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 border-start-0 form-control ms-0" type="password" placeholder="Password">
                        </div>
                        <div class="text-end pt-4">
                            <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
                        </div>

                        <div class="container-login100-form-btn">
                            <a href="index.html" class="login100-form-btn btn-primary">
                                    Login
                            </a>
                        </div>
                        {{-- <div class="text-center pt-3">
                            <p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Sign UP</a></p>
                        </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
