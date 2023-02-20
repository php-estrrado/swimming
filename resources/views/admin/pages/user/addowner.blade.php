@extends('admin.layouts.app')
@section('title', 'Add Salon Owner')
@section('content')
<!-- Page content -->
@if(Session::has('formmsg'))
<div class="alert alert-success alert-dismissible rfalert" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {{ Session::get('formmsg')}}
</div>
{{Session::forget('formmsg')}}
@endif
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users/owner/trial')}}">Trial Salon Owners</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Salon Owner</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Add Salon Owner</h2>
                </div>
                <div class="card-body">
                    <form id="addownerform" name="addownerform" method="POST" action="{{url('admin/users/owner/create')}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Owner Name</label>
                                    <input type="text" class="form-control txtOnly" name="ownername" id="ownername" value="{{old('ownername')}}" maxlength="55" placeholder="Owner Name" onkeypress="return blockSpecialChar(event)" onpaste="return false;">
                                    <div class="error" id="ownername-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Phone" minlength="7" maxlength="12" onkeypress="return isNumber(event)" onpaste="return false;">
                                    <div class="error" id="phone-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address Line1</label>
                                    <input type="text" class="form-control" name="addressline1" id="addressline1" value="{{old('addressline1')}}" placeholder="Address Line1">
                                    <div class="error" id="addressline1-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" minlength="4" value="" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Membership</label>
                                    <select disabled="disabled" name="membership" id="membership" class="form-control custom-select">
                                        <option value="0">Trial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Salon Name</label>
                                    <input type="text" class="form-control" name="salonname" id="salonname" placeholder="Salon Name" value="{{old('salonname')}}" maxlength="55" onkeypress="return blockSpecialChar(event)" placeholder="Salon Name">
                                    <div class="error" id="salonname-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email Id" value="{{old('email')}}" maxlength="255" placeholder="Email Id">
                                    <div class="error" id="email-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address Line2</label>
                                    <input type="text" class="form-control" name="addressline2" id="addressline2" value="{{old('addressline2')}}" placeholder="Address Line2">
                                    <div class="error" id="addressline2-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" minlength="4" value="" placeholder="Confirm Password" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control custom-select">
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="col-md-12 ">
                                <input type="hidden" name="uid" id="uid" value="0">
                                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                                <button id="cancelbtn" type="button" class="btn btn-default mt-1 mb-1">Cancel</button>
                                <button type="submit" class="btn btn-primary mt-1 mb-1">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content .container-fluidd {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .pt-88 {
            padding-top: 0rem !important;
        }
    </style>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            $("body").on("click", "#cancelbtn", function () {
                var baseurl = $("#baseurl").val();
                window.location.href = baseurl + '/admin/users/owner/trial';
            });

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

            var validator = $("#addownerform").validate({
                ignore: ":hidden",
                rules: {
                    ownername: {
                        required: true,
                        maxlength: 55
                    },
                    salonname: {
                        required: true,
                        maxlength: 55
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 55
                    },
                    phone: {
                        required: true,
                        minlength: 5,
                        maxlength: 12
                    },
                    addressline1: {
                        required: true
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
                    ownername: {
                        required: "The ownername field is required.",
                        maxlength: "The maximum length for ownername is 55."
                    },
                    salonname: {
                        required: "The salonname field is required.",
                        maxlength: "The maximum length for salonname is 55."
                    },
                    email: {
                        required: "The email field is required.",
                        email: "The email must be a valid email address.",
                        maxlength: "The maximum length for email is 55."
                    },
                    phone: {
                        required: "The phone field is required.",
                        minlength: "The minimum length for phone is 7.",
                        maxlength: "The maximum length for phone is 12."
                    },
                    addressline1: {
                        required: "The addressline field is required."
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
                    var posturl = $("#addownerform").attr("action");
                    var method = $("#addownerform").attr("method");
                    var uid = $("#uid").val();
                    var usertype = 1;

                    formData.append("usertype", usertype);

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
                            var siteurl = $("#baseurl").val();
                            var redirecturl = siteurl + '/admin/users/owner/trial';

                            if (data.flashtype == 1)
                            {
                                if (data.type == "success") {
                                    window.location.href = redirecturl;
                                } else {
                                    window.location.reload();
                                }

                            } else if (data.flashtype == 2)
                            {
                                $(".error").html("");
                                $("#password, #cpassword").val("");
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                }, function () {
                                    window.location.href = redirecturl;
                                });

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

            $(".txtOnly").keypress(function (event) {
                var key = event.which;
                if (key >= 48 && key <= 57) {
                    event.preventDefault();
                }
            });

        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function blockSpecialChar(event) {
            var key;
            document.all ? key = event.keyCode : key = event.which;
            return ((key > 64 && key < 91) || (key > 96 && key < 123) || key == 8 || key == 32 || (key >= 48 && key <= 57));
        }

    </script>
    @endsection