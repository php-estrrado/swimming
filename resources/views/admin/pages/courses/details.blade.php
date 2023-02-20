@extends('admin.layouts.app')
@section('title', 'Courses')
@section('content')
<?php // echo '<pre>'; print_r($milestones); echo '</pre>'; 
    $course         =   $courseDtl->course;
    $locations      =   $courseDtl->locations;
    $coaches        =   $courseDtl->coaches;
    $courseCode     =   ($course)? $course->course_code : '';
    $courseName     =   ($course)? $course->course_name : ''; 
    $desc           =   ($course)? $course->course_desc : '';
    $coach          =   ($course)? $course->coach : '';
    $location       =   ($course)? $course->location : '';
    $startDate      =   ($course)? $course->start_date : '';
    $endDate        =   ($course)? $course->end_date : '';
    $closingDate    =   ($course)? $course->closing_date : '';
    $created        =   ($course)? $course->created_at : date('Y-m-d H:i:s');
    $created        =   date("d F Y , g:i a",strtotime($created));
    $status         =   ($course)? $course->active : '';
    $reqd           =   '<span class="reqd">*</span>';
?>
<link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/chosen.css')}}">
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('admin/courses')}}">Courses</a></li>
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
                    <ul class="nav nav-tabs">
                       <li id="course-tab" class="active"><a data-toggle="tab" href="#course">Course</a></li><?php
                       if($id > 0){ ?>
                            <li id="media-tab"><a data-toggle="tab" href="#media">Images</a></li> 
                            <li id="ms-tab"><a data-toggle="tab" href="#ms">Milestones</a></li><?php
                       } ?>
                   </ul>
                </div>
                <div id="dtl-content" class="tab-content">
                    <div class="tab-pane active" id="course-tab-content"><br /><br /> 
                        @include('admin.pages.courses.details.general')
                    </div><?php 
                     if($id > 0){ ?>
                        <div class="tab-pane" id="media-tab-content"><br />
                            @include('admin.pages.courses.details.media')
                        </div>
                        <div class="tab-pane" id="ms-tab-content"><br />
                            @include('admin.pages.courses.details.milestones')
                        </div><?php
                     } ?>
                </div>
                <hr />
                <div class="col-md-12 ">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">{{ Form::button('Save', array('class' => 'btn btn-primary pull-right submit_btn', 'id'=>'submit_btn', 'type' => 'submit')) }}</div>
                        <a href="{{url('admin/courses')}}" class="p-2">{{ Form::button('Cancel', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


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
    $('#detail .nav-tabs li').on('click',function(){
        $('#detail .nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active');
        $('#dtl-content .tab-pane').removeClass('active'); $('#dtl-content #'+this.id+'-content').addClass('active');
    });
    
    $('body').on('click','#act-tab .nav-tabs li',function(){
        var tabId   =   this.id;
        var id      =   $('#'+this.id).attr('data-id');
        togleTab(tabId,id);
    });
    
    $('#location').chosen(); $('#coach').chosen();

    $('#submit_btn').on('click',function(){
        $('#courseForm').submit();
    });
});

function togleTab(tabId,id){
    $('#act-tab .nav-tabs li').removeClass('active'); $('#'+tabId).addClass('active'); 
    $('#activity-content-'+id+' .tab-pane').removeClass('active'); $('#activity-content-'+id+' #content-'+tabId).addClass('active');
}
</script>
<script src="{{asset('public/bizzadmin/assets/js/chosen.jquery.js')}}"></script>
@endsection