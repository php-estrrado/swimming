@extends('coach.layouts.app')
@section('title', 'Courses')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">{{$title}}</h2>
            </div>
            <div id="student_list" class="card-body table-card-body">
                @include('coach.pages.courses.list.content')
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
        updateStatus(id,cId,status,url,'student_list','delete',smsg,'users');
    });

});


</script>

@endsection