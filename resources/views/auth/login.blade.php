@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="lgin-card d-flex justify-content-center align-items-center">

            {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

            <div class="card login-container-card p-0">
                <div class="card-body p-0 m-0">
                    <div class="d-flex p-0">
                        <div class="col-6 p-0">
                            <div class="card login-cards">
                                <div class="card-body">
                                    <h2 class="font-weight-bold text-white">
                                        SIMPLIFY <br> MANAGEMENT WITH <br> US
                                    </h2>

                                    <p class="text-white mt-3">
                                        Streamline your workflow, manage resources efficiently, and grow your business with
                                        ease using our smart solutions.
                                    </p>



                                    <div class="d-flex justify-content-center">
                                        <img src="/coffie.png" class="coffiee-img" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card border-0" style="height: 100%">
                                <div class="card-body d-flex align-items-center" style="height: 100%">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-center w-100">
                                            <img src="/logo.png" alt="">

                                        </div>
                                        <h4 class="font-weight-bold text-center mt-5">Welcome Back</h4>
                                        <small class="d-block text-center text-secondary w-100">Please login to your
                                            account</small>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div>
                                                    <div class="mt-3">
                                                        <div class="login-input">
                                                            <i class="fa fa-user"></i>
                                                            <input type="email" name="email" value="{{ old('email') }}"
                                                                placeholder="Email" class="w-full">

                                                        </div>

                                                        @error('email')
                                                            <small role="alert" class="text-danger" style="font-weight: 200">
                                                                <strong>{{ $message }}</strong>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="login-input">
                                                            <i class="fa fa-lock"></i>
                                                            <input type="password" id="password" name="password"
                                                                placeholder="Password" class="w-full">
                                                            {{-- <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i> --}}
                                                        </div>

                                                        @error('password')
                                                            <small role="alert" class="text-danger" style="font-weight: 200">
                                                                <strong>{{ $message }}</strong>
                                                            </small>
                                                        @enderror

                                                    </div>

                                                    <button class="mt-4 cursor-pointer">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
