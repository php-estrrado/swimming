@extends('admin.layouts.app')
@section('title', 'Badges')
@section('content')
@php $badgeImg = ''; @endphp
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
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Badge</button>
            </div>
            <div id="badge_list" class="card-body table-card-body">
                @include('admin.pages.badges.list.content')
            </div>

        </div>
    </div>
</div>

<!-- Add Service Modal Starts-->
<div class="modal fade" id="badgeModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Add Badge</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{ Form::open(array('url' => "admin/course/badge/save", 'id' => 'badgeForm', 'name' => 'badgeForm', 'class' => '','files'=>'true')) }}
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-1">
                        {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
                        {{Form::text('title', '', ['id'=>'title','class' => 'form-control'])}}
                        <span id="title_error" class="error"></span>
                    </div>
                    <div class="col-md-12 mb-2">
                        {{ Form::label('description', 'Description', ['class' => 'control-label required']) }}
                        {{Form::textarea('description','',['id'=>'description','class'=>'form-control required','rows'=>4])}}
                    </div>
                    <div class="col-md-12 mb-1">
                        {{ Form::label('badgeImg', 'Badge image', ['class' => 'control-label required']) }}
                        {{Form::file('badgeImg',['id'=>'badgeImg','class'=>'form-control required','accept'=>'image/*'])}}
                        <span id="img_error" class="error"></span>
                    </div>
                    <div class="col-md-12 mb-1">
                        @if($badgeImg != '') <img id="blah" class="fr" style="width: auto; height: 117px;" src="{{asset('/storage'.$badgeImg)}}"> 
                        @else <img id="blah" class="fr" style="width: auto; height: 110px; " src="" style="display: none;">
                        @endif 
                    </div>
                    <div class="col-md-12 mb-2">
                        {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                        {{Form::select('active',[1=>'Enable',0=>'Disable'],'',['id'=>'active','class'=>'form-control required'])}}
                    </div>
                </div>
                

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <input type="hidden" name="bid" id="bid" value="0">
                    <button type="submit" class="modal-btn btn btn-primary mt-1 mb-1">Save</button>
                    <button id="closeBtn" type="button" class="modal-btn btn btn-sm btn-edit mt-1 mb-1 mr-1">Cancel</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Add Service Modal Ends-->

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
<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
    if('{{$badgeImg}}' == ''){ $('#blah').hide(); }
    $("body").on("change", ".status-btn", function () {
        var id          =   this.id.replace('status-','');
        var bId         =   this.id;
        var sts         =   $(this).prop("checked");
        var url         =   '{{url("/admin/course/update/status")}}';;
        var smsg        =   'Badge activated successfully!';
        if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Badge deactivated successfully!'; }
        updateStatus(id,bId,status,url,'dtrow--','status',smsg,'badges');
    });
    
    $("body").on("click", ".badgeDelBtn", function () { 
        var cId     =   this.id
        var id      =   this.id.replace('badgeDelBtn-','');
        var status  =   0;
        var url     =   '{{url("/admin/course/disable")}}';
        var smsg    =   'Badge deleted successfully!';
        updateStatus(id,cId,status,url,'badge_list','delete',smsg,'badges');
    });
    
    $('body').on('click','.badgeEditBtn',function(){ 
        var id      =   this.id.replace('badgeEditBtn-','');
        var active  =   0;
        if($('#active-'+id).val() == 0){ active = 1; }
        $('#title').val($('#title-'+id).val()); $('#description').val($('#desc-'+id).val());
        $('#blah').attr('src',$('#img-'+id).val()); $('#blah').show();
        $("select#active").prop('selectedIndex', active); $('#bid').val(id);
        $('h2.modal-title').html('Edit Badge'); $('#badgeModal').modal('show'); $('#badgeImg').val('');
    });
    
    $('#addnewbtn').on('click',function(){ 
        $('#title').val(''); $('#description').val(''); $('#blah').hide(); $('#active').val(1); $('#bid').val(0);
        $('h2.modal-title').html('New Badge');  $('#badgeModal').modal('show'); $('#badgeImg').val('');
    });
    $('#closeBtn').on('click',function(){ $('#badgeModal').modal('hide'); });
    
    $("#badgeImg").change(function(){ readURL(this); });
    
    $('#badgeForm').on('submit',function(){
        var result =    true;
        if($('#'+this.id+' #title').val() == ''){ $('#'+this.id+' #title_error').html('Title field is required'); result = false; }else{ $('#'+this.id+' #title_error').html(''); }
        if($('#'+this.id+' #blah').attr('src') == ''){ $('#'+this.id+' #img_error').html('Badge Image field is required'); result = false; }else{ $('#'+this.id+' #img_error').html(''); }
        if(result == true){ $('#badgeForm').submit(); } return false;
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

function readURL(input) { 
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) { $('#blah').attr('src', e.target.result); $('#blah').show(); }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection