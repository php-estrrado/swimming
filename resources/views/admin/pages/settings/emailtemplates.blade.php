@extends('admin.layouts.app')
@section('title', 'Email Templates')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Email Templates</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Email Templates</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Email Template</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="emailtemplates" class="email-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Email Title</th>
                                <th class="wd-20p">Identifier</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($emailtemps) {
                                $slno = 1;
                                foreach ($emailtemps as $emailtemp) {

                                    $na = "N/A";
                                    $title = ($emailtemp->title) ? $emailtemp->title : $na;
                                    $identifier = ($emailtemp->identifier) ? $emailtemp->identifier : $na;

                                    if ($emailtemp->active == 1) {
                                        $active = "Active";
                                        $checked = 'checked="checked"';
                                    } else if ($emailtemp->active == 0) {
                                        $active = "Inactive";
                                        $checked = "";
                                    }
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $emailtemp->id; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo ucfirst($title); ?></td>
                                        <td><?php echo $identifier; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $emailtemp->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $emailtemp->id; ?>">
                                                    <?php echo $active; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <button id="editbtn-<?php echo $emailtemp->id; ?>" class="btn btn-sm btn-primary btn-edit editbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <?php if ($emailtemp->id != 0) { ?>
                                                <button id="deletebtn-<?php echo $emailtemp->id; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
                                            <?php } ?>
                                        </td>
                                    </tr><?php
                                    $slno++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="wd-15p search-by">Search By:</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Email Title</th>
                                <th class="wd-20p">Identifier</th>
                                <th class="wd-10p">Status</th>
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
<style>
    .btn-padd {
        margin-right: 5px;
        margin-top: 4px;
    }
</style>
<script src="{{asset('public/bizzadmin/assets/js/datatable/email-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#addnewbtn", function () {
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/settings/email/new';
    });

    $("body").on("click", ".editbtn", function () {
        var emtid = this.id;
        var emid = emtid.split('-');
        var eid = emid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/settings/email/' + eid;
    });

    $("body").on("click", ".deletebtn", function () {

        var emtid = this.id;
        var emid = emtid.split('-');
        var eid = emid[1];
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
                if (eid != '')
                {
                    window.location.href = baseurl + '/admin/settings/delete/email/' + eid;
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
        var emtid = this.id;
        var emid = emtid.split('-');
        var eid = emid[1];
        var sts = $(this).prop("checked");
        var tablename = "email_template";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/settings/email/changestatus';
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

                if (eid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {eid: eid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + emtid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + emtid).prop("checked", true);
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
                                    var msg = "Email Template Activated Successfully";
                                    $("#csd-" + eid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Email Template Deactivated Successfully";
                                    $("#csd-" + eid).text("Inactive");
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
                        $("#" + emtid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + emtid).prop("checked", true);
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
                    $("#" + emtid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + emtid).prop("checked", true);
                }
            }
        });
    });

});
</script>
@endsection