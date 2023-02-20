@extends('admin.layouts.app')
@section('title', 'Print Templates')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">{{$title}}</h2>
                <a href="{{url('admin/settings/print/0')}}"><button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Template</button></a>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="print_templates" class="print_templates-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-15p">Identifier</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($prints) {
                                $slno = 1;
                                foreach ($prints as $print) { 
                                    $na = "N/A";
                                    $editUrl            =   url("admin/settings/print/$print->id");
                                    if ($print->status == 1) { $active = "Active"; $checked = 'checked="checked"'; } 
                                    else if ($print->status == 0) { $active = "Inactive"; $checked = ""; }
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $print->id; ?>">
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo $print->title; ?></td>
                                        <td><?php echo $print->identifier; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $print->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $print->id; ?>">
                                                    <?php echo $active; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{$editUrl}}"><button id="edit-<?php echo $print->id; ?>" class="btn btn-sm btn-primary btn-edit payeditbtn"><i class="fa fa-edit"></i> Edit</button></a>
                                            <button id="del-<?php echo $print->id; ?>" class="btn btn-sm btn-danger btn-delete delPayBtn"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $slno++;
                                }
                            }
                            ?>
                        </tbody>
<!--                        <tfoot>
                            <tr>
                                <th class="wd-15p search-by">Search By:</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-20p">Identifier</th>
                                <th class="wd-20p">Content</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center action-search"></th>
                            </tr>
                        </tfoot>-->
                    </table>
                    {{ csrf_field() }}
                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                </div>
            </div>

        </div>
    </div>
</div>



<!--<script src="{{asset('public/bizzadmin/assets/js/datatable/payment_method-datatable.js')}}"></script>-->
<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {

    $("body").on("change", ".status-btn", function () {

        var printId     =   this.id;
        var pid         =   printId.split('-');
        var id          =   pid[1];
        var sts         =   $(this).prop("checked");
        var tablename   =   "print_templates";
        var posturl = '{{url("admin/settings/print/status")}}/'+id;
        var method = "GET";
        if (sts == true){ var status = 1; }else{ var status = 0; }

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
                if (id != '')
                {
                    $.blockUI({message: "<h4>Processing...</h4>"});
                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {id: id, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + printId).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + printId).prop("checked", true);
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
                                    var msg = "Templated Activated Successfully";
                                    $("#csd-" + id).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Templated Deactivated Successfully";
                                    $("#csd-" + id).text("Inactive");
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
                        $("#" + printId).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + printId).prop("checked", true);
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
                    $("#" + printId).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + printId).prop("checked", true);
                }
            }
        });
    });

    $("body").on("click", ".delPayBtn", function () {

        var payId = this.id;
        var pid = payId.split('-');
        var id = pid[1];
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
                if (id != '')
                {
                    window.location.href = '{{url("/admin/settings/print/delete")}}/'+id;
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