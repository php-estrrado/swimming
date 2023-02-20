@extends('admin.layouts.app')
@section('title', 'Locations')
@section('content')
<link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/chosen.css')}}">
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
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Location</button>
            </div>
            <div id="location_list" class="card-body table-card-body">
                @include('admin.pages.locations.list.content')
            </div>

        </div>
    </div>
</div>

<!-- Add Service Modal Starts-->
<div class="modal fade" id="addLocModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Add Location</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                {{ Form::open(array('url' => "admin/location/save/0", 'id' => 'addLocform', 'name' => 'addLocform', 'class' => '')) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('location', 'Location Name', ['class' => 'control-label']) }}
                            <?php echo Form::text('location', '', ['id'=>'location','class' => 'form-control']) ?>
                            @if ($errors->has('location'))
                            <span class="error">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('state', 'State', ['class' => 'control-label required']) }}
                            {{Form::select('state',$states,'',['id'=>'state','class'=>'form-control required chosen-select'])}}
                            @if ($errors->has('state'))
                            <span class="error">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                            <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], 1, ['class' => 'form-control']) ?>
                            @if ($errors->has('status'))
                            <span class="error">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-md-12 ">
                        <input type="hidden" name="sid" id="sid" value="0">
                        <button type="submit" class="modal-btn btn btn-primary mt-1 mb-1">Save</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

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
    setTimeout(function(){ $('#state_chosen').css('width', '100%'); },1000);

    $("body").on("change", ".status-btn", function () {
        var id          =   this.id.replace('status-','');
        var lId         =   this.id;
        var sts         =   $(this).prop("checked");
        var url         =   '{{url("/admin/location/update/status")}}';;
        var smsg        =   'Location activated successfully!';
        if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Location deactivated successfully!'; }
        updateStatus(id,lId,status,url,'dtrow--','status',smsg,'cities');
    });
    
    $("body").on("click", ".locDelBtn", function () { 
        var lId     =   this.id
        var id      =   this.id.replace('locDelBtn-','');
        var status  =   0;
        var url     =   '{{url("/admin/location/disable")}}';
        var smsg    =   'Location deleted successfully!';
        updateStatus(id,lId,status,url,'location_list','delete',smsg,'cities');
    });

    $("body").on("click", "#addnewbtn", function () {
        $("#addLocModal").modal("show");
        $(".error").text("");
        $(".modal input").css("color", "#8898aa");
        $(".modal input").css("font-weight", "normal");
        $(".modal input").css("font-size", "14px");
        $("#servicegroup").empty();

        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/services/service/servicegroups";
        var method = "POST";

        $.ajax({
            type: method,
            url: posturl,
            beforeSend: function () {

            },
            data: {},
            success: function (data) {
                if (data != "")
                {
                    $("#sid").val("new");
                    $("#servicename").val("");
                    $("#status").val(1);

                    var servicegroups = data.servicegroups;

                    $("#servicegroup").append('<option selected="selected" value="">Select Service Group</option>');
                    $.each(servicegroups, function (key, value)
                    {
                        $("#servicegroup").append("<option value=" + value.id + ">" + value.group_name + "</option>");
                    });

                }
            }
        });
    });
    
     $("body").on("click", ".editBtn", function () {
        $("#editLocModal").modal("show");
        $(".error").text("");
        
    });

    var addservicevalidator = $("#addLocform").validate({
        ignore: ":hidden",
        rules: {
            location: "required",
            state: "required"
        },
        messages: {
            location: "The location field is required.",
            state: "The state field is required."
        },
        submitHandler: function (form, event) {
            $.blockUI({message: "<h4>Processing...</h4>"});
            $(".modal").modal("hide");
            form.submit();
        }
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
</script>
<script src="{{asset('public/bizzadmin/assets/js/chosen.jquery.js')}}"></script>
<script src="{{asset('public/bizzadmin/assets/js/init.js')}}"></script>
@endsection