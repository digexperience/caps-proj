@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 col-xl-9 col-md-6 col-sm-12">
        <span class="text">
            <strong>
            <i>LO-KI</i> <br />LABORATORY
            LOCK <br />KEY MANAGEMENT<br />
            SYSTEM
            </strong>
        </span>
        </div>
        <div class="col-12 col-lg-6 col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <!-- <div class="card-logo">
                </div> -->
                <div class="card-header" >{{ __('LOGIN') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Enter your email address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="row mb-3">

                            <div class="col-md-12">
                                <div class="password-wrapper">
                                    <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                    <span id="sideicon" class="mdi mdi-eye-off-outline field-icon" onclick="togglePassword()"></span>
                                </div>
                                <script>
                                    function togglePassword() {
                                        var passwordField = document.getElementById("password-field");
                                        var toggleIcon = document.getElementById("sideicon");

                                        if (passwordField.type === "password") {
                                            passwordField.type = "text";
                                            toggleIcon.classList.remove("mdi-eye-off-outline");
                                            toggleIcon.classList.add("mdi-eye-outline");
                                        } else {
                                            passwordField.type = "password";
                                            toggleIcon.classList.remove("mdi-eye-outline");
                                            toggleIcon.classList.add("mdi-eye-off-outline");
                                        }
                                    }
                                </script>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3"> -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                        </div>

                        <!-- <div class="row mb-0"> -->
                            <!-- <div class="col-md-8 offset-md-4"> -->
                                <button type="submit" class="btn">
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
    </div>
    
</div>


@endsection