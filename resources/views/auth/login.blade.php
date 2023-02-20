<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @section('title', 'Login')
    @include('includes.head')

    <body class="bg-gradient-primary body-login">
        <div class="limiter">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                {{ Session::get('success')  }}
            </div>
            @endif
            @if(Session::has('warning'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                {{ Session::get('warning')  }}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                {{ Session::get('error')  }}
            </div>
            @endif
            <div class="container-login100 "  style="padding: 0;">
                <div class="loginleft col-lg-7 col-md-6 col-sm-12 col-12 nopad">
                    <div class="imgbx bxcmn">
                        <img src="{{asset('public/images/loginleft.jpg')}}">
                    </div>
                    <div class="text">
                        
                    </div>

                </div>
                <div class="loginright col-lg-5 col-md-6 col-sm-12 col-12 nopad">
                    <div class="imgbx bxcmn">
                        <img src="{{asset('public/images/loginright.jpg')}}">
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @csrf
                        <span class="login100-form-title">
                            <a href="{{ url('/') }}"><img src="{{asset('public/images/logo.png')}}" alt="" /></a>
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input id="email" type="email" class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required >
                            @if ($errors->has('email'))
                            <span class="error" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input id="password" type="password" class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                            <span class="error" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">

                            <button type="submit" class="login100-form-btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="text-center pt-2">
                            <span class="txt1">
                                <a class="txt2" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            </span>

                        </div>

                        <div class="text-center pt-1">
                            <span class="txt1">
                                Dont't have an account ?
                            </span>
                            <a class="txt2" href="{{ url('/register') }}">
                                Sign Up
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
