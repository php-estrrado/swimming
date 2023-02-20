<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta content="" name="description">
        <meta content="saloon &amp; spa" name="BizzSaloon">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Title -->
        <title>{{ config('app.name', 'Laravel') }} Login</title>
        <!-- Favicon -->
        <link href="{{asset('public/bizzadmin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
        <!-- Icons -->
        <link href="{{asset('public/bizzadmin/assets/css/icons.css')}}" rel="stylesheet">
        <!--Bootstrap.min css-->
        <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
        <!-- Ansta CSS -->
        <link href="{{asset('public/bizzadmin/assets/css/left-style-dashboard.css')}}" rel="stylesheet" type="text/css">
        <!-- Single-page CSS -->
        <link href="{{asset('public/bizzadmin/assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body class="bg-gradient-primary">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-5">
                    <div style="width:100%">
                        <h2 class="text-center" id="">Swimming Administrator</h2>
                        <form id="loginform" name="loginform" method="POST" class="login100-form validate-form" action="{{ url('admin/authenticate') }}">
                            <span class="login100-form-title">
                                Login
                            </span>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="email" id="email" placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="password" name="password" id="password" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="log-fail">@if ($errors->any()){!! implode('<br />', $errors->all(':message')) !!} @endif</div>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="text-center pt-2">
                                <a class="txt2" href="{{url('admin/password/reset')}}">
                                    Forgot Password?
                                </a>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <style>
            .error, .log-fail { 
                color: red; 
                font-size: 12px;
                font-weight: bold;
                padding: 10px 5px 0;
                position: relative;
                margin-bottom: -17px;
            }
            #email, #password {
                color: #000 !important;
                font-size: 14px !important;
                font-weight: normal !important;
                padding-left: 20px !important;
            }
            .focus-input100 {
                position: relative !important;
            }
        </style>
        <!-- Ansta Scripts -->
        <!-- Core -->
        <script src="{{asset('public/bizzadmin/assets/plugins/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/js/popper.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
    };

    // var validator = $("#loginform").validate({
        
    //     ignore: ":hidden",
    //     rules: {
    //         email: {
    //             required: true,
    //             email: true,
    //             maxlength: 55
    //         },
    //         password: {
    //             required: true
    //         }
    //     },
    //     messages: {
    //         email: {
    //             required: "The email field is required.",
    //             email: "The email must be a valid email address.",
    //             maxlength: "The maximum length for email is 55."
    //         },
    //         password: {
    //             required: "The password field is required."
    //         }
    //     },
    //     submitHandler: function (form, event) {
    //         $.blockUI({message: "<h4>Processing...</h4>"});
    //         form.submit();
    //     }
    // });

});
        </script>

    </body>
</html>