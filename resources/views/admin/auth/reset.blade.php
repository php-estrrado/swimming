<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta content="" name="description">
        <meta content="saloon &amp; spa" name="BizzSaloon">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Title -->
        <title>{{ config('app.name', 'Laravel') }} Reset Password</title>
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
        <link href="{{asset('public/bizzadmin/assets/css/sweetalert.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body class="bg-gradient-primary">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-5">
                    <div style="width:100%">
                        <h2 class="text-center" id="">Swmming Administrator</h2>
                        <form id="resetpasswordform" name="resetpasswordform" method="POST" class="login100-form validate-form" action="{{url('admin/resetpassword')}}">
                            <span class="login100-form-title">
                                Reset Password
                            </span>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="text" name="email" id="email" placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                                <div class="error" id="email-err"></div>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="password" name="password" id="password" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                                <div class="error" id="password-err"></div>
                            </div>
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                                <div class="error" id="cpassword-err"></div>
                            </div>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                            <input type="hidden" name="token" id="token" value="{{$validtoken}}">
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .error { 
                color: red; 
                font-size: 12px;
                font-weight: bold;
                padding-left: 3px;
            }
            #email, #password, #cpassword  {
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
        <script src="{{asset('public/bizzadmin/assets/js/sweetalert.min.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('public/bizzadmin/assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>

        <script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("#password").on("blur", function () {
        var password = $("#password").val();
        if (password.length > 0)
        {
            $("#cpassword").removeAttr("readonly");
        } else if (password.length == 0)
        {
            $("#cpassword").attr("readonly", "readonly");
            $("#cpassword").val('');
        }
    });

    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
    };

    var validator = $("#resetpasswordform").validate({
        ignore: ":hidden",
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 55
            },
            password: {
                required: true,
                minlength: 5
            },
            cpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: "The email field is required.",
                email: "The email must be a valid email address.",
                maxlength: "The maximum length for email is 55."
            },
            password: {
                required: "The password field is required.",
                minlength: "The minimum length for password is 5."
            },
            cpassword: {
                required: "The confirm password field is required.",
                minlength: "The minimum length for confirm password is 5.",
                equalTo: "Enter confirm password same as password."
            }
        },
        submitHandler: function (form, event) {
            var formData = new FormData(form);
            var posturl = $("#resetpasswordform").attr("action");
            var method = $("#resetpasswordform").attr("method");

            $.blockUI({message: "<h4>Processing...</h4>"});

            $.ajax({
                type: method,
                url: posturl,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $.unblockUI();

                    if (data.type == "valerror") {
                        $.each(data.msg, function (key, val) {
                            $("#" + key + "-err").html(val[0]);
                        });
                    } else {

                        if (data.flashtype == 1)
                        {
                            window.location.reload();
                        } else if (data.flashtype == 2)
                        {

                            if (data.type == "success")
                            {

                                var siteurl = $("#baseurl").val();
                                var redirecturl = siteurl + "/admin/login";

                                $(".error").html("");
                                $("#email").val("");
                                $("#password").val("");
                                $("#cpassword").val("");

                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                }, function () {
                                    window.location.href = redirecturl;
                                });

                            } else
                            {
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                });
                            }

                        }
                    }
                },
                error: function (json)
                {
                    if (json.status == 422) {
                        $.unblockUI();
                        var msg = json.responseJSON;
                        $.each(msg.errors, function (key, val) {
                            $("#" + key + "-err").html(val[0]);
                        });
                    } else
                    {
                        $.unblockUI();
                        swal({
                            title: "Something went wrong",
                            text: "",
                            type: "error",
                            timer: 2000
                        });
                    }
                }
            });
            return false;
        }
    });

});
        </script>

    </body>
</html>