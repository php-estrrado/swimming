@extends('admin.layouts.app')
@section('title', 'Salon Owner Details')
@section('content')
<!-- Page content -->
<script src="{{asset('public/bizzadmin/assets/js/datatable/callhistory-datatable.js')}}"></script>
<?php
if ($staffmsg != "") {
    ?>
    <div class="alert alert-success alert-dismissible rfalert noanim" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
        {{ $staffmsg }}
    </div>
<?php } ?>
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <?php
            if ($user) {
                if ($user->membership == 0) {
                    ?>
                    <li class="breadcrumb-item"><a href="{{url('admin/users/owner/trial')}}">Trial Salon Owners</a></li>
                <?php } else {
                    ?>
                    <li class="breadcrumb-item"><a href="{{url('admin/users/owner/active')}}">Active Salon Owners</a></li>
                    <?php
                }
            }
            ?>
            <li class="breadcrumb-item active" aria-current="page">Salon Owner Details</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Salon Owner Details</h2>
                    <?php
                    $trial = 0;
                    if ($user && $membership) {

                        if ($user->membership == 0) {
                            $trial = 1;
                        }

                        if ($user->user_type == 1) {
                            if ($user->membership != 0 && $membership->active != 0 && $user->uactive != 0) {
                                ?>
                                <button id="renewbtn" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#renewModal"><i class="fa fa-refresh"></i> Renew Membership Plan</button>
                            <?php } ?>
                            <?php if ($user->uactive != 0 && $membership->active != 0) { ?>
                                <button id="upgradebtn" class="btn btn-sm btn-primary float-right"><i class="fa fa-exchange"></i> Change Membership Plan</button>
                            <?php } ?>
                            <?php
                            if ($user->membership == 0 && $user->uactive != 0) {
                                ?>
                                <button id="addchbtn" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Call History</button>
                            <?php } ?>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="card-body">

                    <?php
                    if ($user) {

                        $na = "N/A";
                        $active = "";
                        $memselected = "";
                        $membership_validity = "";
                        $membership_validity_id = "";
                        $uname = ($user->uname) ? $user->uname : $na;
                        $company_name = ($user->company_name) ? $user->company_name : $na;
                        $email = ($user->email) ? $user->email : $na;
                        $phone = ($user->phone) ? $user->phone : $na;
                        $address1 = ($user->address1) ? $user->address1 : $na;
                        $address2 = ($user->address2) ? $user->address2 : $na;
                        $regdate = dateFormat($user->created_at, 1);
                        $expiry = dateFormat($user->expire_date, 1);

                        if (checkExpiry($expiry) == 0) {
                            $expiry .= ' (Expired)';
                        }

                        if ($user->active == 1) {
                            $active = "Active";
                        } else if ($user->active == 0) {
                            $active = "Inactive";
                        }

                        if ($membership) {
                            $memselected = ($membership->name) ? $membership->name : $na;
                            $membership_validity = ($membership->validity_type) ? $membership->validity_type : $na;
                            $membership_validity_id = ($membership->validity_id) ? $membership->validity_id : 0;
                        }

                        $usertype = $user->user_type;
                        $userid = $user->uid;
                        ?>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Owner Name:</td>
                                                    <td style="width:50%;"><?php echo ucwords($uname); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Salon Name: </td>
                                                    <td style="width:50%;"><?php echo ucwords($company_name); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Phone: </td>
                                                    <td style="width:50%;"><?php echo $phone; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Email: </td>
                                                    <td style="width:50%;"><?php echo $email; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Address Line1: </td>
                                                    <td style="width:50%;"><?php echo ucfirst($address1); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Address Line2: </td>
                                                    <td style="width:50%;"><?php echo ucfirst($address2); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Membership: </td>
                                                    <td style="width:50%;"><?php echo ucwords($memselected); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Membership Validity: </td>
                                                    <td style="width:50%;"><?php echo ucwords($membership_validity); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Registered On: </td>
                                                    <td style="width:50%;"><?php echo $regdate; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Membership Expiry Date: </td>
                                                    <td style="width:50%;"><?php echo $expiry; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Status: </td>
                                                    <td style="width:50%;"><?php echo $active; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <?php
                        if ($trial == 1) {
                            if ($callhistory) {
                                ?>
                                <div class="row subhead">
                                    <div class="col-md-6">
                                        <h3 class="mb-2 float-left chhead">Call History</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                                    </div>
                                </div>
                                <div>
                                    <table id="chistory" class="ch-pag-table table table-striped table-bordered w-100 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p notexport">Select</th>
                                                <th class="wd-15p">Sl No</th>
                                                <th class="wd-10p">Call Date &amp; Time</th>
                                                <th class="wd-15p notexport">Description</th>
                                                <th class="wd-15p dispnone">Description (D)</th>
                                                <th class="wd-15p dispnone">Product Information (D)</th>
                                                <th class="wd-15p">Date of Demo</th>
                                                <th class="wd-15p notexport">Product Information</th>
                                                <th class="wd-20p text-center notexport action-btn">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $slno = 1;
                                            foreach ($callhistory as $callhis) {

                                                $na = "N/A";
                                                $callhisdescription = ($callhis->description) ? subWord($callhis->description, 0, 1) . "..." : $na;
                                                $chdescription = ($callhis->description) ? $callhis->description : $na;
                                                $callhisdate_of_demo = ($callhis->date_of_demo) ? dateFormat($callhis->date_of_demo, 1) : $na;
                                                $callhisproduct_details = ($callhis->product_details) ? subWord($callhis->product_details, 0, 1) . "..." : $na;
                                                $chproduct_details = ($callhis->product_details) ? $callhis->product_details : $na;
                                                $calldatetime = ($callhis->call_datetime) ? dateFormat($callhis->call_datetime, 7) : $na;
                                                ?>
                                                <tr class="dtrow" id="dtrow-<?php echo $callhis->id; ?>">
                                                    <td></td>
                                                    <td><?php echo $slno; ?></td>
                                                    <td><?php echo $calldatetime; ?></td>
                                                    <td><?php echo $callhisdescription; ?></td>
                                                    <td class="dispnone"><?php echo wordwrap($chdescription, 50, "<br />\n"); ?></td>
                                                    <td class="dispnone"><?php echo wordwrap($chproduct_details, 50, "<br />\n"); ?></td>
                                                    <td><?php echo $callhisdate_of_demo; ?></td>
                                                    <td><?php echo $callhisproduct_details; ?></td>
                                                    <td class="text-center">
                                                        <button id="cheditbtn-<?php echo $callhis->id; ?>" class="btn btn-sm btn-primary btn-edit cheditbtn"><i class="fa fa-edit"></i> Edit</button>
                                                        <button id="chdeletebtn-<?php echo $callhis->id; ?>" class="btn btn-sm btn-danger btn-delete chdeletebtn"><i class="fa fa-trash"></i> Delete</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $slno++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="wd-15p search-by">Search By:</th>
                                                <th class="wd-15p">Sl No</th>
                                                <th class="wd-10p dtsearch">Call Date &amp; Time</th>
                                                <th class="wd-15p">Description</th>
                                                <th class="wd-15p dispnone"></th>
                                                <th class="wd-15p dispnone"></th>
                                                <th class="wd-15p dsearch">Date of Demo</th>
                                                <th class="wd-15p">Product Information</th>
                                                <th class="wd-25p text-center action-search"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <br>
                        <h3 class="mb-2 float-left sthead">Staff</h3>
                        <br>
                        <br>
                        <div>
                            <table id="staff" class="staff-pag-table table table-striped table-bordered w-100 text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">Sl No</th>
                                        <th class="wd-15p">Staff Id</th>
                                        <th class="wd-15p">Name</th>
                                        <th class="wd-15p">Email</th>
                                        <th class="wd-15p">Phone</th>
                                        <th class="wd-10p">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($staffs) {
                                        $sslno = 1;
                                        foreach ($staffs as $staff) {

                                            $na = "N/A";
                                            $staffempid = ($staff->emp_id) ? $staff->emp_id : $na;
                                            $staffname = ($staff->name) ? $staff->name : $na;
                                            $staffemail = ($staff->email) ? $staff->email : $na;
                                            $staffphone = ($staff->phone) ? $staff->phone : $na;
                                            $staffid = ($staff->id) ? $staff->id : $na;

                                            if ($staff->active == 1) {
                                                $staffactive = "Active";
                                                $staffchecked = 'checked="checked"';
                                            } else if ($staff->active == 0) {
                                                $staffactive = "Inactive";
                                                $staffchecked = "";
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $sslno; ?></td>
                                                <td><?php echo $staffempid; ?></td>
                                                <td><?php echo ucwords($staffname); ?></td>
                                                <td><?php echo $staffemail; ?></td>
                                                <td><?php echo $staffphone; ?></td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input id="status-<?php echo $staff->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $staffchecked; ?>>
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description" id="csd-<?php echo $staff->id; ?>">
                                                            <?php echo $staffactive; ?>
                                                        </span>
                                                    </label>
                                                </td>
                                            </tr>
                                            <?php
                                            $sslno++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="wd-15p">Sl No</th>
                                        <th class="wd-15p">Staff Id</th>
                                        <th class="wd-15p">Name</th>
                                        <th class="wd-15p">Email</th>
                                        <th class="wd-15p">Phone</th>
                                        <th class="wd-10p">Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="uid" id="uid" value="{{$user->uid}}">
                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Renew Modal Starts-->
    <div class="modal fade" id="renewModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Renew Membership</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <form id="renewmembershipform" name="renewmembershipform" method="POST" action="{{url('admin/users/owner/renew/membership')}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Membership</label>
                                    <input disabled="disabled" class="form-control" type="text" name="membership" id="membership" value="<?php echo ucwords($memselected); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Membership Validity</label>
                                    <input disabled="disabled" class="form-control" type="text" name="mvalidity" id="mvalidity" value="<?php echo ucwords($membership_validity); ?>">
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="col-md-12 ">
                                <input type="hidden" name="validity" id="validity" value="<?php echo $membership_validity_id; ?>">
                                <input type="hidden" name="usertype" id="usertype" value="<?php echo $usertype; ?>">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
                                <button type="submit" class="modal-btn btn btn-primary mt-1 mb-1">Renew</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <!-- Renew Modal Ends-->

    <!-- Add Call History Modal Starts-->
    <div class="modal fade" id="addchModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Save Call History</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $chid = "new";
                    $status = 1;
                    $description = "";
                    $productdetails = "";
                    $demodate = "";
                    $calldatetime = "";
                    ?>
                    {{ Form::open(array('url' => "admin/users/owner/callhistory/save", 'id' => 'addchform', 'name' => 'addchform', 'class' => '')) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Call Date &amp; Time</label>
                                <input type="text" class="form-control datetimepicker" name="calldatetime" id="calldatetime" value="{{$calldatetime}}" readonly="readonly" placeholder="dd-mm-yyyy hh:mm A">
                                <div class="error" id="call-datetime-err"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                                <?php echo Form::textarea('description', $description, ['class' => 'form-control editor', 'rows' => 3]) ?>
                                @if ($errors->has('description'))
                                <span class="error">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Date of Demo</label>
                                <input type="text" class="form-control datepicker" name="dateofdemo" id="dateofdemo" value="{{$demodate}}" readonly="readonly" placeholder="dd-mm-yyyy">
                                <div class="error" id="date-of-demo-err"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('productdetails', 'Product Information', ['class' => 'control-label']) }}
                                <?php echo Form::textarea('productdetails', $productdetails, ['class' => 'form-control editor', 'rows' => 3]) ?>
                                @if ($errors->has('productdetails'))
                                <span class="error">{{ $errors->first('productdetails') }}</span>
                                @endif
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-md-12 ">
                            <input type="hidden" name="status" id="status" value="1">
                            <input type="hidden" name="chid" id="chid" value="<?php echo $chid; ?>">
                            <input type="hidden" name="chuserid" id="chuserid" value="<?php echo $userid; ?>">
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                            <button type="submit" class="modal-btn btn btn-primary mt-1 mb-1">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <!-- Add Call History Modal Ends-->

    <style>
        .main-content .container-fluidd {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .pt-88 {
            padding-top: 0rem !important;
        }
        #upgradebtn {
            margin-right: 0px;
            margin-bottom: 10px;
        }
        #renewbtn {
            margin-left: 5px;
            margin-right: 0px;
            margin-bottom: 10px;
        }
        .close {
            margin-top: -5px !important;
            margin-right: 0px  !important;
        }
        .modal-btn {
            float: right;
        }
        #addchbtn {
            margin-right: 5px;
        }
        .subhead {
            margin-bottom: 10px;
        }
        .chhead, .sthead {
            color: #b10012 !important;
        }
        #staff_wrapper #staff_filter {
            float: right !important;
        }

        /*Datatable Style Starts*/

        /*
        .dt-button-collection a:nth-child(6),
        .dt-button-collection a:nth-child(7)
        {
            display: none !important;
        }
        */

        /*Datatable Style Ends*/


    </style>
    <script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#upgradebtn", function () {
        var userid = $("#uid").val();
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/owner/upgrade/' + userid;
    });

    $("body").on("submit", "#renewmembershipform", function (e) {
        e.preventDefault();
        $.blockUI({message: "<h4>Processing...</h4>"});
        $(".modal").modal("hide");
        $("#renewmembershipform")[0].submit();
    });

    var addchvalidator = $("#addchform").validate({
        ignore: ":hidden",
        rules: {
            calldatetime: "required",
            description: "required"
        },
        messages: {
            calldatetime: "The call date & time field is required.",
            description: "The description field is required."
        },
        submitHandler: function (form, event) {
            $.blockUI({message: "<h4>Processing...</h4>"});
            $(".modal").modal("hide");
            form.submit();
        }
    });

    $("body").on("click", "#addchbtn", function () {
        $("#addchModal").modal("show");
        $(".error").text("");
        $(".modal input, .modal textarea").css("color", "#8898aa");
        $(".modal input, .modal textarea").css("font-weight", "normal");
        $(".modal input, .modal textarea").css("font-size", "14px");
        $("#chid").val("new");
        $("#calldatetime, #description, #dateofdemo, #productdetails").val("");
        $("#status").val(1);
    });

    $("body").on("click", ".cheditbtn", function () {
        var baseurl = $("#baseurl").val();
        $("#addchModal").modal("show");
        $(".error").text("");
        $(".modal input, .modal textarea").css("color", "#8898aa");
        $(".modal input, .modal textarea").css("font-weight", "normal");
        $(".modal input, .modal textarea").css("font-size", "14px");
        $("#chid, #calldatetime, #description, #dateofdemo, #productdetails").val("");
        $("#status").val(1);

        var chistid = this.id;
        var chisid = chistid.split('-');
        var chid = chisid[1];
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/users/owner/callhistory/getcallhistory";
        var method = "POST";

        $.ajax({
            type: method,
            url: posturl,
            beforeSend: function () {

            },
            data: {chid: chid},
            success: function (data) {
                if (data != "")
                {
                    $("#chid").val(data.chistory.chid);
                    $("#calldatetime").val(data.chistory.calldatetime);
                    $("#description").val(data.chistory.description);
                    $("#dateofdemo").val(data.chistory.dateofdemo);
                    $("#productdetails").val(data.chistory.product_details);
                    $("#status").val(data.chistory.active);
                }
            }
        });

    });

    $("body").on("click", ".chdeletebtn", function () {

        var chistid = this.id;
        var chisid = chistid.split('-');
        var chid = chisid[1];
        var baseurl = $("#baseurl").val();

        swal({
            title: "Are you sure?",
            text: "",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                if (chid != '')
                {
                    window.location.href = baseurl + '/admin/users/owner/callhistory/delete/' + chid;
                } else
                {
                    swal({
                        title: "Something went wrong",
                        text: "",
                        type: "error",
                        timer: 2000
                    });
                }
            }
        });

    });

    /*Datetime Picker Starts*/

    $(".datetimepicker").datetimepicker({
        timeZone: '',
        format: 'DD-MM-YYYY hh:mm A',
        dayViewHeaderFormat: 'MMMM YYYY',
        extraFormats: false,
        stepping: 1,
        minDate: '2019/01/01',
        maxDate: new Date(),
        useCurrent: true,
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
        keepOpen: true,
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

    /*Datetime Picker Ends*/

    /*Date Picker Starts*/

    $(".datepicker").datetimepicker({
        timeZone: '',
        format: 'DD-MM-YYYY',
        dayViewHeaderFormat: 'MMMM YYYY',
        extraFormats: false,
        stepping: 1,
        minDate: new Date(),
        maxDate: false,
        useCurrent: true,
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
        showTodayButton: true,
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

    /*Staff Datatable Starts*/

    $(".staff-pag-table tfoot th").each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    var table = $("#staff").DataTable({
        pageLength: 10,
        rowReorder: false,
        colReorder: true,
        paging: true,
        pagingType: "simple_numbers",
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        fixedHeader: true,
        orderCellsTop: false,
        keys: false,
        responsive: true,
        processing: true,
        scrollX: false,
        scrollCollapse: true,
        serverSide: false,
        search: {
            caseInsensitive: true,
            smart: true
        },
        orderMulti: false,
        order: [[0, "asc"]],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            decimal: "",
            emptyTable: "No staff found",
            info: "Showing _START_ to _END_ of _TOTAL_ staff",
            infoEmpty: "Showing 0 to 0 of 0 staff",
            infoFiltered: "(filtered from _MAX_ total staff)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Show _MENU_ staff",
            loadingRecords: "Loading...",
            processing: "Processing...",
            search: "Search:",
            zeroRecords: "No matching staff found",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            buttons: {
                copyTitle: 'Copied to clipboard',
                copySuccess: {
                    _: "%d rows copied",
                    1: "1 row copied"
                }
            }
        }
    });

    table.columns().every(function () {
        var that = this;

        $("input", this.footer()).on("keyup change", function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });

    /*Staff Datatable ends*/

    $("body").on("change", ".status-btn", function () {
        var staffid = this.id;
        var stid = staffid.split('-');
        var sid = stid[1];
        var sts = $(this).prop("checked");
        var tablename = "staffs";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/users/owner/staff/changestatus';
        var method = "POST";

        if (sts == true)
        {
            var status = 1;
        } else if (sts == false)
        {
            var status = 0;
        }

        swal({
            title: "Are you sure?",
            text: "",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {

                if (sid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {sid: sid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + staffid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + staffid).prop("checked", true);
                                }
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                });
                            } else {
                                if (status == 1)
                                {
                                    var msg = "Staff Activated Successfully";
                                    $("#csd-" + sid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Staff Deactivated Successfully";
                                    $("#csd-" + sid).text("Inactive");
                                }
                                swal({
                                    title: msg,
                                    text: "",
                                    type: "success",
                                    timer: 2000
                                }, function () {
                                    window.location.reload(true);
                                });
                            }
                        }
                    });
                } else
                {
                    if (status == 1)
                    {
                        $("#" + staffid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + staffid).prop("checked", true);
                    }
                    swal({
                        title: "Something went wrong",
                        text: "",
                        type: "error",
                        timer: 2000
                    });
                }
            } else
            {
                if (status == 1)
                {
                    $("#" + staffid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + staffid).prop("checked", true);
                }
            }
        });
    });

});

    </script>
    @endsection