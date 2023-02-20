@extends('admin.layouts.app')
@section('title', 'Edit Admin User')
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
            <li class="breadcrumb-item"><a href="{{url('admin/users/admin')}}">Admin Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Admin User</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Edit Admin User</h2>
                </div>
                <div class="card-body">
                    <?php
                    if ($user) {

                        $active = "";
                        $inactive = "";
                        $superadmin = "";
                        $admin = "";
                        $sadisabled = "";

                        if ($user->active == 1) {
                            $active = 'selected="selected"';
                        } else if ($user->active == 0) {
                            $inactive = 'selected="selected"';
                        }
                        if ($user->role == 1) {
                            $superadmin = 'selected="selected"';
                        } else if ($user->role == 2) {
                            $admin = 'selected="selected"';
                        }
                        if ($user->role == 1 && $user->id == $userdata['id']) {
                            $sadisabled = 'disabled="disabled"';
                        }
                        ?>
                        <form id="editadminform" name="editadminform" method="POST" action="{{url('admin/users/admin/update')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control txtOnly" name="username" id="username" value="<?php echo ucwords(htmlspecialchars($user->name, ENT_COMPAT)); ?>" maxlength="55" placeholder="Name" onkeypress="return blockSpecialChar(event)" onpaste="return false;">
                                        <div class="error" id="ownername-err"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user->phone; ?>" minlength="7" maxlength="12"  placeholder="Phone" onkeypress="return isNumber(event)" onpaste="return false;">
                                        <div class="error" id="phone-err"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="cpassword" id="cpassword" value="" minlength="4" placeholder="Confirm Password" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control custom-select">
                                            <option <?php echo $active; ?> value="1">Enable</option>
                                            <option <?php echo $inactive; ?> value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo $user->email; ?>" maxlength="255" placeholder="Email Id">
                                        <div class="error" id="email-err"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="" minlength="4" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Role</label>
                                        <select name="urole" id="urole" class="form-control custom-select" <?php echo $sadisabled; ?>>
                                            <?php if ($userdata['role'] == 1) { ?>
                                                <option <?php echo $superadmin; ?> value="1">Super Admin</option>
                                            <?php } ?>
                                            <option <?php echo $admin; ?> value="2">Admin</option>
                                        </select>
                                    </div>

                                </div>
                                {{ csrf_field() }}
                                <div class="col-md-12 ">
                                    <?php if ($user->role == 1 && $user->id == $userdata['id']) { ?>
                                        <input type="hidden" name="sarole" id="sarole" value="1">
                                    <?php } else { ?>
                                        <input type="hidden" name="sarole" id="sarole" value="0">
                                    <?php } ?>
                                    <input type="hidden" name="uid" id="uid" value="{{$user->id}}">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                                    <button id="cancelbtn" type="button" class="btn btn-default mt-1 mb-1">Cancel</button>
                                    <button type="submit" class="btn btn-primary mt-1 mb-1">Update</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
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
                window.location.href = baseurl + '/admin/users/admin';
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

            var validator = $("#editadminform").validate({
                ignore: ":hidden",
                rules: {
                    username: {
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
                    password: {
                        minlength: 5
                    },
                    cpassword: {
                        minlength: 5,
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        required: "The username field is required.",
                        maxlength: "The maximum length for username is 55."
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
                    password: {
                        minlength: "The minimum length for password is 5."
                    },
                    cpassword: {
                        minlength: "The minimum length for confirm password is 5.",
                        equalTo: "Enter confirm password same as password."
                    }
                },
                submitHandler: function (form, event) {

                    var formData = new FormData(form);
                    var posturl = $("#editadminform").attr("action");
                    var method = $("#editadminform").attr("method");
                    var uid = $("#uid").val();

                    var sarole = $("#sarole").val();

                    if (sarole == 0)
                    {
                        var role = $("#urole").val();
                    } else if (sarole == 1)
                    {
                        var role = 1;
                    }

                    formData.append("role", role);

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
                            var redirecturl = siteurl + '/admin/users/admin';

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