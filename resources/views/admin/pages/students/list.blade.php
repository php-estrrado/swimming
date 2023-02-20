@extends('admin.layouts.app')
@section('title', 'Students')
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
<!--                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>-->
                <a href="{{url('/admin/user/student/0')}}" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add User</a>
            </div>
            <div id="student_list" class="card-body table-card-body">
                @include('admin.pages.students.list.content')
            </div>

        </div>
    </div>
</div>

<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
    $("body").on("change", ".status-btn", function () {
        var id          =   this.id.replace('status-','');
        var bId         =   this.id;
        var sts         =   $(this).prop("checked");
        var url         =   '{{url("/admin/student/update/status")}}';;
        var smsg        =   'Student activated successfully!';
        if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Student deactivated successfully!'; }
        updateStatus(id,bId,status,url,'dtrow--','status',smsg,'users');
    });
    
    $("body").on("click", ".studentDelBtn", function () { 
        var cId     =   this.id
        var id      =   this.id.replace('studentDelBtn-','');
        var status  =   0;
        var url     =   '{{url("/admin/student/disable")}}';
        var smsg    =   'Student deleted successfully!';
        updateStatus(id,cId,status,url,'student_list','delete',smsg,'users','student');
    });

});

function updateStatus(id,cId,status,url,row,type,smsg,table,userType){
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
        if (isConfirm){
            if (id != ''){
                $.blockUI({message: "<h4>Processing...</h4>"});
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {id: id, active: status,table: table, userType: userType},
                    success: function (data) {
                        $.unblockUI();
                        if (data.type == 'warning' || data.type == 'error'){
                            if(status == 1){ $("#"+cId).prop("checked", false); } else if (status == 0){ $("#"+cId).prop("checked", true); }
                            swal({ title: data.msg,text: "",type: data.type,timer: 2000});
                        } else {
                            if (status == 1){ $("#csd-" + id).text("Active"); }else if (status == 0){$("#csd-" + id).text("Inactive"); }
                            swal({title: smsg,text: "",type: "success",timer: 2000});
                            if(type == 'delete'){ $('#'+row).html(data); }
                        }
                    }
                });
            } else
            {
                if (status == 1)
                {
                    $("#" + cId).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + cId).prop("checked", true);
                }
                swal({
                    title: "Something went wrong",
                    text: "",
                    type: "error",
                    timer: 2000
                });
            }
        }else{ if(status == 1){ $("#" + cId).prop("checked", false); }else if (status == 0){ $("#" + cId).prop("checked", true); } }
    });
}
</script>

@endsection