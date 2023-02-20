@extends('admin.layouts.app')
@section('title', 'Add Customer')
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
            <li class="breadcrumb-item"><a href="{{url('admin/users/customer')}}">Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Customer</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Add Customer</h2>
                </div>
                <div class="card-body">
                    <form id="addcustomerform" name="addcustomerform" method="POST" action="{{url('admin/users/customer/create')}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Customer Name</label>
                                    <input type="text" class="form-control txtOnly" name="customername" id="customername" value="{{old('customername')}}" maxlength="55" placeholder="Customer Name" onkeypress="return blockSpecialChar(event)" onpaste="return false;">
                                    <div class="error" id="customername-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="Phone" minlength="7" maxlength="12" onkeypress="return isNumber(event)" onpaste="return false;">
                                    <div class="error" id="phone-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control custom-select">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Anniversary</label>
                                    <input type="text" class="form-control datepicker" name="anniversary" id="anniversary" value="{{old('anniversary')}}" placeholder="dd-mm-yyyy" readonly="readonly">
                                    <div class="error" id="anniversary-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" minlength="4" value="" placeholder="Password">
                                </div>
                                <?php if ($owners) { ?>
                                    <div class="form-group">
                                        <label class="form-label">Company Name</label>
                                        <select name="company" id="company" class="form-control custom-select">
                                            <option value="">Select</option>
                                            <?php foreach ($owners as $owner) { ?>
                                                <option value="<?php echo $owner->uid; ?>"><?php echo ucwords($owner->company_name); ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="error" id="company-err"></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email Id" value="{{old('email')}}" maxlength="255" placeholder="Email Id">
                                    <div class="error" id="email-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">DOB</label>
                                    <input type="text" class="form-control datepicker" name="dob" id="dob" value="{{old('dob')}}" placeholder="dd-mm-yyyy" readonly="readonly">
                                    <div class="error" id="dob-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" id="location" value="{{old('location')}}" placeholder="Location">
                                    <div class="error" id="location-err"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control txtOnly" name="address" id="address" value="{{old('address')}}" placeholder="Address">
                                    <div class="error" id="address-err"></div>
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
                window.location.href = baseurl + '/admin/users/customer';
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

            var validator = $("#addcustomerform").validate({
                ignore: ":hidden",
                rules: {
                    customername: {
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
                        required: true,
                        minlength: 5
                    },
                    cpassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    company: {
                        required: true
                    }
                },
                messages: {
                    customername: {
                        required: "The customer name field is required.",
                        maxlength: "The maximum length for customername is 55."
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
                        required: "The password field is required.",
                        minlength: "The minimum length for password is 5."
                    },
                    cpassword: {
                        required: "The confirm password field is required.",
                        minlength: "The minimum length for confirm password is 5.",
                        equalTo: "Enter confirm password same as password."
                    },
                    company: {
                        required: "The company field is required."
                    }
                },
                submitHandler: function (form, event) {

                    var formData = new FormData(form);
                    var posturl = $("#addcustomerform").attr("action");
                    var method = $("#addcustomerform").attr("method");
                    var uid = $("#uid").val();
                    var usertype = 2;

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
                            var redirecturl = siteurl + '/admin/users/customer';

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

            /*Date Picker Starts*/

            $(".datepicker").datetimepicker({
                timeZone: '',
                format: 'DD-MM-YYYY',
                dayViewHeaderFormat: 'MMMM YYYY',
                extraFormats: false,
                stepping: 1,
                minDate: '1919/01/01',
                maxDate: new Date(),
                useCurrent: false,
                collapse: true,
                locale: moment.locale(),
                defaultDate: false,
                disabledDates: false,
                enabledDates: false,
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-crosshairs',
                    clear: 'fa fa-trash-o',
                    close: 'fa fa-times'
                },
                tooltips: {
                    today: 'Go to today',
                    clear: 'Clear selection',
                    close: 'Close the picker',
                    selectMonth: 'Select Month',
                    prevMonth: 'Previous Month',
                    nextMonth: 'Next Month',
                    selectYear: 'Select Year',
                    prevYear: 'Previous Year',
                    nextYear: 'Next Year',
                    selectDecade: 'Select Decade',
                    prevDecade: 'Previous Decade',
                    nextDecade: 'Next Decade',
                    prevCentury: 'Previous Century',
                    nextCentury: 'Next Century',
                    pickHour: 'Pick Hour',
                    incrementHour: 'Increment Hour',
                    decrementHour: 'Decrement Hour',
                    pickMinute: 'Pick Minute',
                    incrementMinute: 'Increment Minute',
                    decrementMinute: 'Decrement Minute',
                    pickSecond: 'Pick Second',
                    incrementSecond: 'Increment Second',
                    decrementSecond: 'Decrement Second',
                    togglePeriod: 'Toggle Period',
                    selectTime: 'Select Time'
                },
                useStrict: false,
                sideBySide: false,
                daysOfWeekDisabled: [],
                calendarWeeks: false,
                viewMode: 'days',
                toolbarPlacement: 'default',
                showTodayButton: false,
                showClear: true,
                showClose: true,
                widgetPositioning: {
                    horizontal: 'auto',
                    vertical: 'auto'
                },
                widgetParent: null,
                ignoreReadonly: true,
                keepOpen: false,
                focusOnShow: true,
                inline: false,
                keepInvalid: false,
                datepickerInput: '.datepickerinput',
                debug: false,
                allowInputToggle: false,
                disabledTimeIntervals: false,
                disabledHours: false,
                enabledHours: false,
                viewDate: false
            }).on("dp.hide", function () {

            }).on("dp.show", function () {

            }).on("dp.change", function () {

            }).on("dp.error", function () {

            }).on("dp.update", function () {

            });

            /*Date Picker Ends*/

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