@extends('admin.layouts.app')
@section('title', 'Trial Salon Owners')
@section('content')
@if(Session::has('formmsg'))
<div class="alert alert-success alert-dismissible rfalert" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {{ Session::get('formmsg')}}
</div>
{{Session::forget('formmsg')}}
@endif
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Trial Salon Owners</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Trial Salon Owners</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-user-plus"></i> Add Salon Owner</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="trialownerslist" class="trialowner-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Company Name</th>
                                <th class="wd-15p">Email</th>
                                <th class="wd-20p">Phone Number</th>
                                <th class="wd-10p">Name</th>
                                <th class="wd-20p">Expires On</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($users) {
                                $slno = 1;
                                foreach ($users as $user) {

                                    $na = "N/A";
                                    $company_name = ($user->company_name) ? $user->company_name : $na;
                                    $email = ($user->email) ? $user->email : $na;
                                    $phone = ($user->phone) ? $user->phone : $na;
                                    $name = ($user->uname) ? $user->uname : $na;
                                    $expire_date = ($user->expire_date) ? $user->expire_date : $na;

                                    if ($user->uactive == 1) {
                                        $active = "Active";
                                        $checked = 'checked="checked"';
                                    } else if ($user->uactive == 0) {
                                        $active = "Inactive";
                                        $checked = "";
                                    }

                                    if (checkExpiry($expire_date) == 1) {
                                        $expiry = dateFormat($expire_date, 1);
                                    } else if (checkExpiry($expire_date) == 0) {
                                        $expiry = "Expired";
                                    }
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $user->uid; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo ucfirst($company_name); ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo ucwords($name); ?></td>
                                        <td><?php echo $expiry; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $user->uid; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $user->uid; ?>">
                                                    <?php echo $active; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <button id="viewbtn-<?php echo $user->uid; ?>" class="btn btn-sm btn-success btn-view viewbtn"><i class="fa fa-eye"></i> View</button>
                                            <button id="editbtn-<?php echo $user->uid; ?>" class="btn btn-sm btn-primary btn-edit editbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <button id="deletebtn-<?php echo $user->uid; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $slno++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="wd-15p search-by">Search By:</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Company Name</th>
                                <th class="wd-15p">Email</th>
                                <th class="wd-20p">Phone Number</th>
                                <th class="wd-10p">Name</th>
                                <th class="wd-20p">Expires On</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-25p text-center action-search"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{ csrf_field() }}
                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                </div>
                <button id="send-expiry-sms-btn" type="button" class="btn btn-sm btn-primary mt-1 mb-1"><i class="fa fa-paper-plane"></i> Send System Generated Message</button>
                <button id="send-expiry-mail-btn" type="button" class="btn btn-sm btn-primary mt-1 mb-1"><i class="fa fa-paper-plane-o"></i> Send Subscription Expiry Mail</button>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-padd {
        margin-right: 5px;
        margin-top: 4px;
    }
</style>
<script src="{{asset('public/bizzadmin/assets/js/datatable/trialowner-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#addnewbtn", function () {
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/owner/new';
    });

    $("body").on("click", ".editbtn", function () {
        var uid = this.id;
        var usrid = uid.split('-');
        var userid = usrid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/owner/edit/' + userid;
    });

    $("body").on("click", ".viewbtn", function () {
        var uid = this.id;
        var usrid = uid.split('-');
        var userid = usrid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/owner/view/' + userid;
    });

    $("body").on("click", ".deletebtn", function () {

        var uid = this.id;
        var usrid = uid.split('-');
        var userid = usrid[1];
        var tablename = "users";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/users/user/delete';
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
                if (userid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {userid: userid, tablename: tablename},
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
                                swal({
                                    title: "Shop Owner Deleted Successfully",
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

    $("body").on("change", ".status-btn", function () {
        var uid = this.id;
        var usrid = uid.split('-');
        var userid = usrid[1];
        var sts = $(this).prop("checked");
        var tablename = "users";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/users/user/changestatus';
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

                if (userid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {userid: userid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + uid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + uid).prop("checked", true);
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
                                    var msg = "Salon Owner Activated Successfully";
                                    $("#csd-" + userid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Salon Owner Deactivated Successfully";
                                    $("#csd-" + userid).text("Inactive");
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
                        $("#" + uid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + uid).prop("checked", true);
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
                    $("#" + uid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + uid).prop("checked", true);
                }
            }
        });
    });

});
</script>
@endsection