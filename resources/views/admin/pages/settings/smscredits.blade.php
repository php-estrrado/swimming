@extends('admin.layouts.app')
@section('title', 'Sms Credit &amp; Packages')
@section('content')
@inject('settingsService', 'App\Services\Admin\SettingsService')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sms Credit &amp; Packages</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Sms Credit &amp; Packages</h2>
            </div>

            <div class="card-body table-card-body">
                <h3 class="mb-2 float-left sthead">Sms Packages</h3>
                <br>
                <br>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Sms Package Details</button>
                <div>
                    <table id="smspackages" class="smspackages-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Package Name</th>
                                <th class="wd-15p">No of Messages</th>
                                <th class="wd-15p">Amount</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($smspackages) {

                                $spslno = 1;

                                foreach ($smspackages as $smspackage) {

                                    $na = "N/A";
                                    $packagename = ($smspackage->package_name) ? $smspackage->package_name : $na;
                                    $noofmessages = ($smspackage->noofmessages) ? $smspackage->noofmessages : 0;
                                    $amount = ($smspackage->amount) ? $smspackage->amount : 0;

                                    if ($smspackage->active == 1) {
                                        $spactive = "Active";
                                        $spchecked = 'checked="checked"';
                                    } else if ($smspackage->active == 0) {
                                        $spactive = "Inactive";
                                        $spchecked = "";
                                    }

                                    $amountdisp = $amount . getCurrencySymbol();
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $smspackage->id; ?>">
                                        <td></td>
                                        <td><?php echo $spslno; ?></td>
                                        <td><?php echo ucfirst($packagename); ?></td>
                                        <td><?php echo $noofmessages; ?></td>
                                        <td><?php echo $amountdisp; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $smspackage->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $spchecked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $smspackage->id; ?>">
                                                    <?php echo $spactive; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <button id="speditbtn-<?php echo $smspackage->id; ?>" class="btn btn-sm btn-primary btn-edit speditbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <button id="spdeletebtn-<?php echo $smspackage->id; ?>" class="btn btn-sm btn-danger btn-delete spdeletebtn"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr><?php
                                    $spslno++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="wd-15p search-by">Search By:</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Package Name</th>
                                <th class="wd-15p">No of Messages</th>
                                <th class="wd-15p">Amount</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-25p text-center action-search"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card-body table-card-body">
                <h3 class="mb-2 float-left sthead">Sms Credits (Users)</h3>
                <br>
                <br>
                <div>
                    <table id="smscredits" class="smscredits-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Company Name</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($smscredits) {

                                if ($smscredits[0]) {

                                    $slno = 1;

                                    foreach ($smscredits[0] as $smscredit) {

                                        $na = "N/A";
                                        $companyname = ($smscredit->company_name) ? $smscredit->company_name : $na;
                                        ?>
                                        <tr class="scdtrow" id="scdtrow-<?php echo $smscredit->id; ?>">
                                            <td><?php echo $slno; ?></td>
                                            <td><?php echo ucfirst($companyname); ?>
                                                <?php
                                                $reqcount = $settingsService->getSmsRequestCount($smscredit->uid);
                                                if ($reqcount > 0) {
                                                    ?>
                                                    <i class="fa fa-bell"><?php echo $reqcount; ?></i>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <button id="creditbtn-<?php echo $smscredit->uid; ?>" class="btn btn-sm btn-primary btn-edit creditbtn"><i class="fa fa-edit"></i> Edit</button>
                                            </td>
                                        </tr><?php
                                        $slno++;
                                    }
                                }

                                if ($smscredits[1]) {

                                    $admslno = $slno;

                                    foreach ($smscredits[1] as $admsmscredit) {

                                        $na = "N/A";
                                        $admname = ($admsmscredit->name) ? $admsmscredit->name : $na;
                                        ?>
                                        <tr class="scdtrow" id="scdtrow-<?php echo $admsmscredit->id; ?>">
                                            <td><?php echo $admslno; ?></td>
                                            <td><?php echo ucfirst($admname); ?></td>
                                            <td class="text-center">
                                                <button id="creditbtn-<?php echo $admsmscredit->id; ?>" class="btn btn-sm btn-primary btn-edit creditbtn"><i class="fa fa-edit"></i> Edit</button>
                                            </td>
                                        </tr><?php
                                        $admslno++;
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Company Name</th>
                                <th class="wd-25p text-center action-search"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{ csrf_field() }}
                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Sms Package Details Modal Starts-->
<div class="modal fade" id="spdModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Sms Package Details</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $spdactive = 1;
                $spdid = "new";
                $modnoofmessages = "";
                $modpackagename = "";
                $modamount = 0;
                ?>
                {{ Form::open(array('url' => "admin/settings/smspackagedetails/save", 'id' => 'spdform', 'name' => 'spdform', 'class' => '', 'files' => true)) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('packagename', 'Package Name', ['class' => 'control-label']) }}
                            <?php echo Form::text('packagename', $modpackagename, ['class' => 'form-control']) ?>
                            @if ($errors->has('packagename'))
                            <span class="error">{{ $errors->first('packagename') }}</span>
                            @endif
                            <span id="packagename_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('noofmessages', 'No of Messages', ['class' => 'control-label']) }}
                            <?php echo Form::text('noofmessages', $modnoofmessages, ['class' => 'form-control']) ?>
                            @if ($errors->has('noofmessages'))
                            <span class="error">{{ $errors->first('noofmessages') }}</span>
                            @endif
                            <span id="noofmessages_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('amount', 'Amount', ['class' => 'control-label']) }}
                            <?php echo Form::text('amount', $modamount, ['class' => 'form-control']) ?>
                            @if ($errors->has('amount'))
                            <span class="error">{{ $errors->first('amount') }}</span>
                            @endif
                            <span id="amount_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <div class="form-group">
                            {{ Form::label('spdstatus', 'Status', ['class' => 'control-label']) }}
                            <?php echo Form::select('spdstatus', [0 => 'Disable', 1 => 'Enable'], $spdactive, ['class' => 'form-control']) ?>
                            @if ($errors->has('spdstatus'))
                            <span class="error">{{ $errors->first('spdstatus') }}</span>
                            @endif
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-md-12 ">
                        <input type="hidden" name="spdid" id="spdid" value="<?php echo $spdid; ?>">
                        {{ Form::button('Save', array('name' => 'savebtn', 'class' => 'btn btn-primary', 'type' => 'submit')) }}
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
<!-- Sms Package Details Modal Ends-->

<!-- Sms Credits Modal Starts-->
<div class="modal fade" id="scModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Sms Credits Details</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="scmbody">


            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
<!-- Sms Sms Credits Modal Ends-->

<style>
    #addnewbtn {
        margin-left: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        height: 25px;
        margin-top: -4px !important;
    }
    #delete-all-btn {
        margin-top: -4px !important;
        margin-right: 0px;
        margin-bottom: 10px;
        height: 25px;
    }
    .btn-padd {
        margin-right: 5px;
        margin-top: 4px;
    }
    .dt-bootstrap4 .dataTables_filter {
        float: right !important;
    }
    #smspackages_filter {
        float: left !important;
    }
    .close {
        margin-top: -5px !important;
        margin-right: 0px  !important;
    }
    .modal-btn {
        float: right;
    }
</style>
<script src="{{asset('public/bizzadmin/assets/js/datatable/smspackages-datatable.js')}}"></script>
<script src="{{asset('public/bizzadmin/assets/js/datatable/smscredits-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#addnewbtn", function () {
        var baseurl = $("#baseurl").val();
        $("#spdModal").modal("show");
        $("#spdid").val("new");
        $("#packagename").val("");
        $("#noofmessages").val(0);
        $("#amount").val(0);
        $("#spdstatus").val(1);
        $(".error").text("");
    });

    $("body").on("click", ".speditbtn", function () {
        var smtid = this.id;
        var smid = smtid.split('-');
        var sid = smid[1];
        $("#spdModal").modal("show");
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/settings/smspackagedetails/get";
        var method = "POST";

        $.ajax({
            type: method,
            url: posturl,
            beforeSend: function () {

            },
            data: {sid: sid},
            success: function (data) {

                $("#spdid").val(sid);
                $("#packagename").val(data.package.package_name);
                $("#noofmessages").val(data.package.noofmessages);
                $("#amount").val(data.package.amount);
                $("#spdstatus").val(data.package.active);

                $(".modal input").css("color", "#8898aa");
                $(".modal input").css("font-weight", "normal");
                $(".modal input").css("font-size", "14px");

            }
        });

    });

    $("body").on("click", ".creditbtn", function () {
        var userid = this.id;
        var usrid = userid.split('-');
        var uid = usrid[1];
        $("#scModal").modal("show");
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/settings/smsrequest/get";
        var method = "POST";

        $.ajax({
            type: method,
            url: posturl,
            beforeSend: function () {

            },
            data: {uid: uid},
            success: function (data) {
                $("#scmbody").html(data.result);
            }
        });

    });

    $("body").on("click", ".approvebtn", function () {
        var requestid = this.id;
        var rqstid = requestid.split('-');
        var rid = rqstid[1];
        var tablename = "sms_package_users";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/settings/smscredits/approve';
        var method = "POST";

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

                if (rid != '')
                {

                    $("#scModal").modal("hide");
                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {rid: rid, status: 0, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                });
                            } else {
                                var msg = "Sms Package Activated Successfully";
                                swal({
                                    title: msg,
                                    text: "",
                                    type: "success",
                                    timer: 2000
                                }, function () {
                                    window.location.reload();
                                });
                            }
                        }
                    });
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

    var spdvalidator = $("#spdform").validate({
        ignore: ":hidden",
        rules: {
            packagename: {
                required: true,
                maxlength: 50
            },
            noofmessages: {
                required: true,
                number: true
            },
            amount: {
                required: true,
                number: true
            },
            status: {
                required: true
            }
        },
        messages: {
            packagename: {
                required: "The package name field is required.",
                maxlength: "The maximum length for packagename is 50."
            },
            noofmessages: {
                required: "The no of messages field is required.",
                number: "The no of messages field must be numeric."
            },
            amount: {
                required: "The amount field is required.",
                number: "The amount field must be numeric."
            },
            status: {
                required: "The status field is required."
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            $.blockUI({message: "<h4>Processing...</h4>"});
            $(".modal").modal("hide");
            form.submit();

        }
    });

    $("body").on("change", ".status-btn", function () {

        var packageid = this.id;
        var pkgid = packageid.split('-');
        var pid = pkgid[1];
        var sts = $(this).prop("checked");
        var tablename = "sms_package_details";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/settings/smspackagedetails/changestatus';
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

                if (pid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {pid: pid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + packageid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + packageid).prop("checked", true);
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
                                    var msg = "Sms Package Activated Successfully";
                                    $("#csd-" + pid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Sms Package Deactivated Successfully";
                                    $("#csd-" + pid).text("Inactive");
                                }
                                swal({
                                    title: msg,
                                    text: "",
                                    type: "success",
                                    timer: 2000
                                });
                            }
                        }
                    });
                } else
                {
                    if (status == 1)
                    {
                        $("#" + packageid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + packageid).prop("checked", true);
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
                    $("#" + packageid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + packageid).prop("checked", true);
                }
            }
        });
    });

    $("body").on("click", ".spdeletebtn", function () {
        var packageid = this.id;
        var pkgid = packageid.split('-');
        var pid = pkgid[1];
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
                if (pid != '')
                {
                    window.location.href = baseurl + '/admin/settings/delete/spd/' + pid;
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

});
</script>
@endsection