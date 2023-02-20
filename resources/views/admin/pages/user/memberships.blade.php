@extends('admin.layouts.app')
@section('title', 'Memberships')
@section('content')
@inject('userService', 'App\Services\Admin\UserService')
<?php
$currency_symbol = getCurrencySymbol();
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Memberships</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Memberships</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Membership</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="ownerslist" class="membership-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-20p">Validity</th>
                                <th class="wd-20p">Price</th>
                                <th class="wd-20p">No of Staff</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($memberships) {
                                $acmems = "";
                                $actmems = "";
                                $memusers = 0;
                                $slno = 1;
                                foreach ($memberships as $membership) {

                                    $na = "N/A";
                                    $membership_name = ($membership->name) ? $membership->name : $na;
                                    $staff = ($membership->staff) ? $membership->staff : $na;

                                    $msplans = $userService->getMembershipDetails($membership->id);
                                    $memusers = $userService->checkMembershipUsers($membership->id);

                                    if ($membership->active == 1) {
                                        $active = "Active";
                                        $checked = 'checked="checked"';
                                    } else if ($membership->active == 0) {
                                        $active = "Inactive";
                                        $checked = "";
                                    }
                                    if ($memusers > 0) {
                                        $actmems .= ",$membership->id";
                                    }
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $membership->id; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo ucfirst($membership_name); ?></td>
                                        <td>
                                            <?php
                                            foreach ($msplans as $msplan) {
                                                echo ucfirst($msplan->validity_type) . '<br>';
                                            }
                                            ?> 
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($msplans as $msplan) {
                                                echo $currency_symbol . ' ' . $msplan->price . '<br>';
                                            }
                                            ?>                                        
                                        </td>
                                        <td><?php echo $staff; ?></td>
                                        <td>
                                            <?php if ($membership->id != 0) { ?>
                                                <label class="custom-switch">
                                                    <input id="status-<?php echo $membership->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description" id="csd-<?php echo $membership->id; ?>">
                                                        <?php echo $active; ?>
                                                    </span>
                                                </label>
                                            <?php } else { ?>
                                                <?php echo $active; ?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <button id="editbtn-<?php echo $membership->id; ?>" class="btn btn-sm btn-primary btn-edit editbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <?php if ($membership->id != 0 && $memusers == 0) { ?>
                                                <button id="deletebtn-<?php echo $membership->id; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
                                            <?php } ?>
                                        </td>
                                    </tr><?php
                                    $slno++;
                                }
                            }
                            if ($actmems != "") {
                                $acmems = substr($actmems, 1);
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="wd-15p search-by">Search By:</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-20p">Validity</th>
                                <th class="wd-20p">Price</th>
                                <th class="wd-20p">No of Staff</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center action-search"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{ csrf_field() }}
                    <input type="hidden" name="acmems" id="acmems" value="<?php echo $acmems; ?>">
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
<script src="{{asset('public/bizzadmin/assets/js/datatable/membership-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", "#addnewbtn", function () {
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/membership/new';
    });

    $("body").on("click", ".editbtn", function () {
        var mid = this.id;
        var memsid = mid.split('-');
        var memid = memsid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/users/membership/' + memid;
    });

    $("body").on("click", ".deletebtn", function () {

        var memid = this.id;
        var memsid = memid.split('-');
        var mid = memsid[1];
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
                if (mid != '')
                {
                    window.location.href = baseurl + '/admin/users/delete/membership/' + mid;
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
        var memid = this.id;
        var memsid = memid.split('-');
        var mid = memsid[1];
        var sts = $(this).prop("checked");
        var tablename = "membership";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/users/membership/changestatus';
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

                if (mid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {mid: mid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + memid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + memid).prop("checked", true);
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
                                    var msg = "Membership Activated Successfully";
                                    $("#csd-" + mid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Membership Deactivated Successfully";
                                    $("#csd-" + mid).text("Inactive");
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
                        $("#" + memid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + memid).prop("checked", true);
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
                    $("#" + memid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + memid).prop("checked", true);
                }
            }
        });
    });

});
</script>
@endsection