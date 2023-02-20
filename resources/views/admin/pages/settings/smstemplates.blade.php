@extends('admin.layouts.app')
@section('title', 'Sms Templates')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sms Templates</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Sms Templates</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Sms Template</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="smstemplates" class="sms-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Sms Title</th>
                                <th class="wd-20p">Identifier</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($smstemps) {
                                $slno = 1;
                                foreach ($smstemps as $smstemp) {

                                    $na = "N/A";
                                    $title = ($smstemp->title) ? $smstemp->title : $na;
                                    $identifier = ($smstemp->identifier) ? $smstemp->identifier : $na;

                                    if ($smstemp->active == 1) {
                                        $active = "Active";
                                        $checked = 'checked="checked"';
                                    } else if ($smstemp->active == 0) {
                                        $active = "Inactive";
                                        $checked = "";
                                    }
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $smstemp->id; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo ucfirst($title); ?></td>
                                        <td><?php echo $identifier; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $smstemp->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $smstemp->id; ?>">
                                                    <?php echo $active; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <button id="editbtn-<?php echo $smstemp->id; ?>" class="btn btn-sm btn-primary btn-edit editbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <?php if ($smstemp->id != 0) { ?>
                                                <button id="deletebtn-<?php echo $smstemp->id; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
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
                                <th class="wd-15p">Sms Title</th>
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
<script src="{{asset('public/bizzadmin/assets/js/datatable/sms-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#addnewbtn", function () {
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/settings/sms/new';
    });

    $("body").on("click", ".editbtn", function () {
        var smtid = this.id;
        var smid = smtid.split('-');
        var sid = smid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/settings/sms/' + sid;
    });

    $("body").on("click", ".deletebtn", function () {

        var smtid = this.id;
        var smid = smtid.split('-');
        var sid = smid[1];
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
                if (sid != '')
                {
                    window.location.href = baseurl + '/admin/settings/delete/sms/' + sid;
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
        var smtid = this.id;
        var smid = smtid.split('-');
        var sid = smid[1];
        var sts = $(this).prop("checked");
        var tablename = "sms_template";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/settings/sms/changestatus';
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
                        data: {smsid: sid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + smtid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + smtid).prop("checked", true);
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
                                    var msg = "Sms Template Activated Successfully";
                                    $("#csd-" + sid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Sms Template Deactivated Successfully";
                                    $("#csd-" + sid).text("Inactive");
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
                        $("#" + smtid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + smtid).prop("checked", true);
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
                    $("#" + smtid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + smtid).prop("checked", true);
                }
            }
        });
    });

});
</script>
@endsection