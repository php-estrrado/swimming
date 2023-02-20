@extends('coach.layouts.app')
@section('title', 'Submitted Activities')
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
                @include('coach.pages.activities.list.content')
            </div>

        </div>
    </div>
</div>

<script>

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $(document).ready(function () {
        $('body').on('click','.actApprove',function(){ 
            var id      =   this.id.replace('app-','');
            var regAct  =   $(this).attr('data-id');
            var msg     =   'Activity Approved Successfully';
            var url     =   '{{url("coach/update/course/activity")}}';
            var studId  =   $('#user-'+id).val();
            updateStatus(id,regAct,3,url,'Complete','action',msg,'submited_activities','act_status',studId);
        });
        $('body').on('click','.actReject',function(){
            var id      =   this.id.replace('rej-','');
            var regAct  =   $(this).attr('data-id');
            var msg     =   'Activity Rejected Successfully';
            var url     =   '{{url("coach/update/course/activity")}}';
            var studId  =   $('#user-'+id).val();
            updateStatus(id,regAct,4,url,'Rejected','action',msg,'submited_activities','act_status',studId);
        });

    });

    function updateStatus(id,aId,status,url,row,type,msg,table,status_type,studId){ 
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
                        data: {id: id, status: status, aId: aId,table: table, field: status_type,student_id: studId},
                        success: function (data) {
                            $.unblockUI();
                             $('.statusMsg').show(); 
                            $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                            $('#status-'+id).html(row); $('#app-'+id).hide();  $('#rej-'+id).hide();
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                        }
                    });
                } 
            }
        });
    }

</script>

@endsection