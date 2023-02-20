@extends('coach.layouts.app')
@section('title', 'Courses')
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
            <div id="course_list" class="card-body table-card-body">
                @include('coach.pages.session.list.content')
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
    
    $("body").on("click", ".approveBtn", function () {
        var cId     =   this.id
        var id      =   this.id.replace('a-','');
        var id      =   id.replace('r-','');
        var sts     =   $(this).attr("data-value"); 
        var url     =   '{{url("/coach/session/update/status")}}';
        var smsg    =   'Request approved successfully!';
        var studId  =   $('#user-'+id).val();
        updateStatus(id,cId,sts,url,'dtrow-','status',smsg,'request_extra_activity_session','act_status',studId);
    });


});

function updateStatus(id,cId,status,url,row,type,smsg,table,field,studId){
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
                    data: {id: id, status: status,table: table,field: field,student_id: studId},
                    success: function (data) {
                        $.unblockUI(); $('.statusMsg').show(); 
                            if(data.type == 'success'){ $('#a-'+id).attr('disabled',true); $('#r-'+id).attr('disabled',true); $('#act_status-'+id).html(status) }
                            $(".statusMsg").html('<div class="alert alert-'+data.type+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+data.msg+'</div>');
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
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