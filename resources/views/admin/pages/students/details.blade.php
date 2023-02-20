@extends('admin.layouts.app')
@section('title', 'Student')
@section('content')
<?php // echo '<pre>'; print_r($student); echo '</pre>';  echo 'ssss';
    $name           =   ($student)? $student->name : '';
    $phone          =   ($student)? $student->phone : ''; 
    $email          =   ($student)? $student->email : '';
    $isParent       =   ($student)? $student->is_parent : 0;
    $address1       =   ($student)? $student->address1 : '';
    $address2       =   ($student)? $student->address2 : '';
    $avthar         =   ($student)? $student->avthar : '';
    $active_from    =   ($student)? $student->active_from : '';
    $created_at     =   ($student)? $student->created_at : '';
    $status         =   ($student)? $student->active : 1;
    if($id          >   0){ $roleDisable = true; }else{ $roleDisable = false; }
    $reqd           =   '<span class="reqd">*</span>';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/user/students')}}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">{{$title}}</h2>
            </div>
            <div class="card-body">
                 <div id="detail" class="">
                    <?php if($student && $student->is_parent > 0){ ?>
                        <ul class="nav nav-tabs">
                            <li id="user-tab" class="active"><a data-toggle="tab" href="#course">Detail</a></li>
                            <li id="child-tab"><a data-toggle="tab" href="#media">Children</a></li> 
                        </ul>
                     <?php } ?>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="user-tab-content"><br /><br /> 
                        @include('admin.pages.students.details.general')
                    </div>
                    <div class="tab-pane" id="child-tab-content"> 
                        <div id="childList">@include('admin.pages.students.details.children')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Child Modal Starts-->
<div class="modal fade" id="addChildModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="act-title" class="modal-title">Add Activity</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{ Form::open(array('url' => "admin/student/save", 'id' => 'childForm', 'name' => 'childForm', 'class' => '')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            {{ Form::label('name', 'Child Name', ['class' => 'control-label','maxlength'=>150]) }}
                            {{Form::text('name', '', ['id'=>'name','class' => 'form-control','pattern'=>'[A-Za-z ]{2,35}','title'=>'Enter valid name','required'=>true])}}
                            <span id="error_name" class="error"></span>
                    </div>
                    <div class="col-md-12">
                            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                            {{Form::email('email', '', ['id'=>'email','class' => 'form-control'])}}
                            <span id="error_act_desc" class="error"></span>
                    </div>
                    <div class="col-md-12">
                            {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}  
                            {{Form::text('phone', '', ['id'=>'phone','class' => 'form-control','pattern'=>'.{7,13}','title'=>'* The phone must be between 7 and 13 digits'])}}
                            <span id="error_act_desc" class="error"></span>
                    </div>
                    <div class="col-md-12">
                            {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                            {{Form::select('active',[1=>'Active',0=>'Inactive'],'',['id'=>'active','class'=>'form-control required chosen-select'])}}
                    </div>
                    <div class="col-md-12 ">
                        {{Form::hidden('is_parent',0)}} {{Form::hidden('parent',$id)}} {{Form::hidden('cId',0,['id'=>'cId'])}} 
                        {{Form::hidden('address1','')}} {{Form::hidden('passType','ajax')}}
                    </div>

                </div>

            </div>

            <!-- Modal footer -->

            <div class="modal-footer">

                <div class="col-md-12 ">

                    <div class="fr">


                        <button id="child-close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>

                        <button id="submit-child" type="submit" class="btn btn-primary mt-1">Save</button>

                    </div>

                </div>

            </div>

            {{ Form::close() }}

        </div>

    </div>

</div>
<!-- Add Child Modal Ends-->

<style>
    .btn-padd {
        margin-right: 5px;
        margin-top: 4px;
    }
    .close {
        margin-top: -5px !important;
        margin-right: 0px  !important;
    }
    .modal-btn {
        float: right;
    }
</style>
<script src="{{asset('public/bizzadmin/assets/js/datatable/location-datatable.js')}}"></script>
<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.nav-tabs li').on('click',function(){
        $('.nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active');
        $('.tab-content .tab-pane').removeClass('active'); $('.tab-content #'+this.id+'-content').addClass('active');
    });
    
    $('#coachForm').on('submit',function(){ $('#coachForm #is_parent').attr('disabled',false); });
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
        updateStatus(id,cId,status,url,'childList','delete',smsg,'users','child');
    });
    
    $('body').on('click','#addChild',function(){ 
        $('#childForm #name').val(''); $('#childForm #email').val(''); $('#childForm #phone').val(''); $('#childForm #active').val(1); 
        $('#childForm #cId').val(0); $('#addChildModal').modal('show'); 
    });
    $('body').on('click','#child-close-btn',function(){ $('#addChildModal').modal('hide'); });
    
    $('#childForm').on('submit',function(){
        var result      =   true;
        if($('#'+this.id+' #name').val() == ''){ $('#'+this.id+' #error_name').html('Name is required field'); result = false;}
        else{ $('#'+this.id+' #error_name').html(''); }
        if(result == true){ 
            if($('#'+this.id+' #email').val() == ''){ $('#'+this.id+' #email').val('test@test.com'); } if($('#'+this.id+' #phone').val() == ''){ $('#'+this.id+' #phone').val('0000000'); }
            $('#submit-child').prop('disabled',true); $('#submit-child').html('Saving ...');
            if($('#'+this.id+' #cId').val() > 0){ var msg = 'Child updated successfully!'; }else{ var msg = 'Child added successfully!'; }
          //  return false;
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
                    $('#childList').html(data); $('#submit-child').prop('disabled',false); $('#submit-child').html('Save');
                    $('.statusMsg').show(); $('#addChildModal').modal('hide');
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    $('#childForm #name').val(''); $('#childForm #email').val(''); $('#childForm #phone').val(''); $('#childForm #active').val(1);
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                    return false;
                }
            });
        }
        return false;
    });
    
    $('body').on('click','.childEditBtn',function(){
        var id      =   this.id.replace('childEditBtn-',''); 
        if($('#status-'+id).prop('checked') == true){ var active = 1; }else{ var active = 0; } 
        $('#childForm #name').val($('#name_'+id).val()); $('#childForm #email').val($('#email_'+id).val()); 
        $('#childForm #phone').val($('#phone_'+id).val());  $('#childForm #active').val(active);
        $('#childForm #cId').val(id); $('#addChildModal').modal('show');
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
                    data: {id: id, active: status,table: table, userType: userType,parent: '{{$id}}'},
                    success: function (data) {
                        $.unblockUI();
                        if (data.type == 'warning' || data.type == 'error'){
                            if(status == 1){ $("#"+cId).prop("checked", false); } else if (status == 0){ $("#"+cId).prop("checked", true); }
                            swal({ title: data.msg,text: "",type: data.type,timer: 2000});
                        } else {
                            if (status == 1){ $("#csd-" + id).text("Active"); $("#"+cId).prop("checked", true);  }
                            else if (status == 0){$("#csd-" + id).text("Inactive"); $("#"+cId).prop("checked", false);  }
                            swal({title: smsg,text: "",type: "success",timer: 2000});
                            if(type == 'delete'){ $('#'+row).html('<br /><br /> '+data); }
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