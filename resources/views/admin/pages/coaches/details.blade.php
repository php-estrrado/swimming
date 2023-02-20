@extends('admin.layouts.app')
@section('title', 'Courses')
@section('content')
<?php // echo '<pre>'; print_r($course); echo '</pre>'; 
    $name           =   ($coach)? $coach->name : '';
    $phone          =   ($coach)? $coach->phone : ''; 
    $email          =   ($coach)? $coach->email : '';
    $location       =   ($coach)? $coach->city : '';
    $address1       =   ($coach)? $coach->address1 : '';
    $address2       =   ($coach)? $coach->address2 : '';
    $avthar         =   ($coach)? $coach->avthar : '';
    $active_from    =   ($coach)? $coach->active_from : '';
    $created_at     =   ($coach)? $coach->created_at : '';
    $status         =   ($coach)? $coach->active : 1;
    $reqd           =   '<span class="reqd">*</span>';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/user/coaches')}}">Coaches</a></li>
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
                {{ Form::open(array('url' => "admin/coach/save", 'id' => 'coachForm', 'name' => 'coachForm', 'class' => '','files'=>'true')) }}
                    {{Form::hidden('cId', $id)}}
<!--                    <div class="">
                        <ul class="nav nav-tabs">
                           <li id="course-tab" class="active"><a data-toggle="tab" href="#staff">Course</a></li>&nbsp;
                           <li id="ms-tab"><a data-toggle="tab" href="#wl">Milestones</a></li>
                           <li id="wh-tab"><a data-toggle="tab" href="#wh">Working Hours</a></li> 
                           <li id="dob-tab"><a data-toggle="tab" href="#dob">Day off / Breaks</a></li> 
                           <li id="ser-tab"><a data-toggle="tab" href="#ser">Services</a></li>
                           <li id="accp-tab"><a data-toggle="tab" href="#accp">Access Permissions</a></li>
                           <li id="prof-tab"><a data-toggle="tab" href="#prof">Professional Details</a></li>
                       </ul>
                    </div>-->
                    <div class="tab-content">
                        <div class="tab-pane active" id="course-tab-content"><br /><br /> 
                            @include('admin.pages.coaches.details.general')
                        </div>
                       
                    </div>
                    <hr />
                    <div class="col-md-12 ">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">{{ Form::button('Save', array('class' => 'btn btn-primary pull-right submit_btn', 'type' => 'submit')) }}</div>
                            <div class="p-2"><a href="{{url('/admin/user/coaches')}}">{{ Form::button('Cancel', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
                        </div>
                    </div>
                {{ Form::close() }}  
            </div>
        </div>
    </div>
</div>

<!-- Add Service Modal Starts-->
<div class="modal fade" id="addserviceModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Save Service</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $id = 0;
                $servicename = "";
                $sgroupid = "";
                $sactive = 1;
                ?>
                {{ Form::open(array('url' => "admin/services/service/save", 'id' => 'addserviceform', 'name' => 'addserviceform', 'class' => '')) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('servicename', 'Service Name', ['class' => 'control-label']) }}
                            <?php echo Form::text('servicename', $servicename, ['class' => 'form-control']) ?>
                            @if ($errors->has('servicename'))
                            <span class="error">{{ $errors->first('servicename') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('servicegroup', 'Service Group', ['class' => 'control-label']) }}
                            <select name="servicegroup" id="servicegroup" class="form-control"></select>
                            @if ($errors->has('servicegroup'))
                            <span class="error">{{ $errors->first('servicegroup') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                            <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], $sactive, ['class' => 'form-control']) ?>
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


    $("body").on("click", "#addnewbtn", function () {
        $("#addserviceModal").modal("show");
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

    $("body").on("click", ".serviceeditbtn", function () {
        var baseurl = $("#baseurl").val();
        $("#addserviceModal").modal("show");
        $(".error").text("");
        $(".modal input").css("color", "#8898aa");
        $(".modal input").css("font-weight", "normal");
        $(".modal input").css("font-size", "14px");
        $("#servicename").val("");
        $("#status").val(1);
        $("#servicegroup").empty();

        var serviceid = this.id;
        var srvcid = serviceid.split('-');
        var sid = srvcid[1];
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/services/service/getservice";
        var method = "POST";

        $.ajax({
            type: method,
            url: posturl,
            beforeSend: function () {

            },
            data: {sid: sid},
            success: function (data) {
                if (data != "")
                {
                    $("#sid").val(data.service.sid);
                    $("#servicename").val(data.service.servicename);
                    $("#status").val(data.service.active);

                    var selservicegroup = data.service.servicegroup;
                    var servicegroups = data.servicegroups;

                    $.each(servicegroups, function (key, value)
                    {
                        $("#servicegroup").append("<option value=" + value.id + ">" + value.group_name + "</option>");
                    });
                    $("#servicegroup").val(selservicegroup);
                }
            }
        });

    });

    var addservicevalidator = $("#addserviceform").validate({
        ignore: ":hidden",
        rules: {
            servicename: "required",
            servicegroup: "required"
        },
        messages: {
            servicename: "The service name field is required.",
            servicegroup: "The service group field is required."
        },
        submitHandler: function (form, event) {
            $.blockUI({message: "<h4>Processing...</h4>"});
            $(".modal").modal("hide");
            form.submit();
        }
    });

    $("body").on("change", ".status-btn", function () {
        $(this).prop("checked",true); return false;
        var serviceid = this.id;
        var srvcid = serviceid.split('-');
        var sid = srvcid[1];
        var sts = $(this).prop("checked");
        var tablename = "services";
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + '/admin/services/service/changestatus';
        var method = "POST";

        if (sts == true)
        {
            var status = 1;
        } else if (sts == false)
        {
            var status = 0;
        }

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
            if (isConfirm) {

                if (sid != '')
                {

                    $.blockUI({message: "<h4>Processing...</h4>"});

                    $.ajax({
                        type: method,
                        url: posturl,
                        data: {sid: sid, status: status, tablename: tablename},
                        success: function (data) {
                            $.unblockUI();
                            if (data.type == 'warning' || data.type == 'error')
                            {
                                if (status == 1)
                                {
                                    $("#" + serviceid).prop("checked", false);
                                } else if (status == 0)
                                {
                                    $("#" + serviceid).prop("checked", true);
                                }
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                });
                            } else {
                                if (status == 1)
                                {
                                    var msg = "Service Activated Successfully";
                                    $("#csd-" + sid).text("Active");
                                } else if (status == 0)
                                {
                                    var msg = "Service Deactivated Successfully";
                                    $("#csd-" + sid).text("Inactive");
                                }
                                swal({
                                    title: msg,
                                    text: "",
                                    type: "success",
                                    timer: 2000
                                });
                            }
                        }
                    });
                } else
                {
                    if (status == 1)
                    {
                        $("#" + serviceid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + serviceid).prop("checked", true);
                    }
                    swal({
                        title: "Something went wrong",
                        text: "",
                        type: "error",
                        timer: 2000
                    });
                }
            } else
            {
                if (status == 1)
                {
                    $("#" + serviceid).prop("checked", false);
                } else if (status == 0)
                {
                    $("#" + serviceid).prop("checked", true);
                }
            }
        });
    });

    $("body").on("click", ".servicedeletebtn", function () {

        var serviceid = this.id;
        var srvcid = serviceid.split('-');
        var sid = srvcid[1];
        var baseurl = $("#baseurl").val();

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
            if (isConfirm) {
                if (sid != '')
                {
                    window.location.href = baseurl + '/admin/services/service/delete/' + sid;
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

    });

});
</script>
@endsection