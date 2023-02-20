@extends('admin.layouts.app')
@section('title', 'Contacts')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contacts</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">Contacts</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="emailtemplates" class="contact-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-15p">Name</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-10p">Subject</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if ($contacts) {
                                $slno = 1;
                                foreach ($contacts as $contact) {

                                    $na = "N/A";
                                    $name = ($contact->name) ? $contact->name : $na;
                                    $email = ($contact->email) ? $contact->email : $na;
                                    $subject = ($contact->subject) ? $contact->subject : $na;
                                    ?>
                                    <tr class="dtrow" id="dtrow-<?php echo $contact->id; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo ucfirst($name); ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo subWord($subject, 0, 3) . "..."; ?></td>
                                        <td class="text-center">
                                            <button id="viewbtn-<?php echo $contact->id; ?>" class="btn btn-sm btn-success btn-view viewbtn"><i class="fa fa-eye"></i> View</button>
                                            <button id="deletebtn-<?php echo $contact->id; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
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
                                <th class="wd-15p">Name</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-10p">Subject</th>
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
<script src="{{asset('public/bizzadmin/assets/js/datatable/contact-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("click", ".viewbtn", function () {
        var cntid = this.id;
        var cnid = cntid.split('-');
        var cid = cnid[1];
        var baseurl = $("#baseurl").val();
        window.location.href = baseurl + '/admin/contact/view/' + cid;
    });

    $("body").on("click", ".deletebtn", function () {

        var cntid = this.id;
        var cnid = cntid.split('-');
        var cid = cnid[1];
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
                if (cid != '')
                {
                    window.location.href = baseurl + '/admin/contact/delete/' + cid;
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