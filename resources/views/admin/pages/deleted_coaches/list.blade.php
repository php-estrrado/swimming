@extends('admin.layouts.app')
@section('title', 'Disabled Coaches')
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
            <div id="coach_list" class="card-body table-card-body">
                @include('admin.pages.deleted_coaches.list.content')
            </div>

        </div>
    </div>
</div>

<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
    $("body").on("click", ".coachResBtn", function () { 
        var cId     =   this.id
        var id      =   this.id.replace('coachResBtn-','');
        var url     =   '{{url("/admin/user/restore")}}/'+id;
        var smsg    =   'Coach enabled successfully!'; 
        updateStatus(id,cId,url,'coach_list','restore',smsg,'users');
    });

});

function updateStatus(id,cId,url,row,type,smsg,table){
    swal({
        title: "Are you sure?", text: "", type: "info", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "Yes", cancelButtonText: "No", closeOnConfirm: true, closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm){
                $.blockUI({message: "<h4>Processing...</h4>"});
                window.location.href = url;
        }
    });
}
</script>

@endsection