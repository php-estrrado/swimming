@extends('admin.layouts.app')
@section('title', 'Registered Courses')
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
                <a href="{{url('/admin/course/0')}}">
                    <button id="addCoursebtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Course</button>
                </a>
            </div>
            <div id="course_list" class="card-body table-card-body">
                @include('admin.pages.registered_courses.list.content')
            </div>

        </div>
    </div>
</div>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $("body").on("change", ".status-btn", function () {
        var cId     =   this.id
        var id      =   this.id.replace('status-','');
        var sts     =   $(this).prop("checked");
        var url     =   '{{url("/admin/course/update/status")}}';
        var smsg    =   'Course activated successfully!';
        if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Course deactivated successfully!'; } 
        updateStatus(id,cId,status,url,'dtrow-','status',smsg,'courses');
    });

    $("body").on("click", ".courseDelBtn", function () { 
        
        var cId     =   this.id
        var id      =   this.id.replace('courseDelBtn-','');
        var status  =   0;
        var url     =   '{{url("/admin/course/disable")}}';
        var smsg    =   'Course deleted successfully!';
        updateStatus(id,cId,status,url,'dtrow-','delete',smsg,'courses');


    });

});

function updateStatus(id,cId,status,url,row,type,smsg,table){
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
                    data: {id: id, active: status,table: table},
                    success: function (data) {
                        $.unblockUI();
                        if (data.type == 'warning' || data.type == 'error'){
                            if(status == 1){ $("#"+cId).prop("checked", false); } else if (status == 0){ $("#"+cId).prop("checked", true); }
                            swal({ title: data.msg,text: "",type: data.type,timer: 2000});
                        } else {
                            if (status == 1){ $("#csd-" + id).text("Active"); }else if (status == 0){$("#csd-" + id).text("Inactive"); }
                            swal({title: smsg,text: "",type: "success",timer: 2000});
                            if(type == 'delete'){ $('#course_list').html(data); }
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