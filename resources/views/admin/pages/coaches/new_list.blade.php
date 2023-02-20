@extends('admin.layouts.app')
@section('title', 'New Coaches')
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
            </div>
            <div id="new_coach_list" class="card-body table-card-body">
                @include('admin.pages.coaches.list.new_content')
            </div>
        </div>
    </div>
</div>

<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () { 
    $("body").on("click", ".status-btn", function () {
        var id          =   this.id;
        var bId         =   this.id;
        var sts         =   $(this).attr('data-status');
        var url         =   '{{url("/admin/coach/aprove")}}/'+id+'/'+sts;
        var smsg        =   'Coach activated successfully!';
        if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Coach deactivated successfully!'; }
        updateStatus(id,bId,status,url,'dtrow--','status',smsg,'users');
    });
    
    $("body").on("click", ".coachDelBtn", function () { 
        var cId     =   this.id
        var id      =   this.id.replace('coachDelBtn-','');
        var status  =   0;
        var url     =   '{{url("/admin/coach/disable")}}';
        var smsg    =   'Coach deleted successfully!';
        updateStatus(id,cId,status,url,'new_coach_list','delete',smsg,'users');
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
                window.location.href = url;
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
}
</script>

@endsection