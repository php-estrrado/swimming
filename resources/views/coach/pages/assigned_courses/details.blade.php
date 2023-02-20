@extends('coach.layouts.app')
@section('title', 'Courses')
@section('content')
 <?php // echo '<pre>'; print_r($course); echo '</pre>'; 
    $courseCode     =   ($course)? $course->course_code : '';
    $courseName     =   ($course)? $course->course_name : ''; 
    $desc           =   ($course)? $course->course_desc : '';
    $coach          =   ($course)? $course->name : '';
    $location       =   ($course)? $course->location : '';
    $endDate        =   ($course)? $course->end_date : '';
    $startDate      =   ($course)? $course->start_date : '';
    $closingDate    =   ($course)? $course->closing_date : '';
    //$status         =   ($course)? $course->status_name : '';
    $reqd           =   '<span class="reqd">*</span>';
?> 
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/assigned/courses')}}">Assigned Courses</a></li>
        <li class="breadcrumb-item active" aria-current="page">{!! $title !!}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">{!! $title !!}</h2>
            </div>
            <div class="card-body">
                <div id="detail" class="">
                    <ul class="nav nav-tabs">
                       <li id="course-tab" class="active"><a data-toggle="tab" href="#course">Course</a></li>

                      <?php
                       if($id > 0){ ?>
                            <li id="media-tab"><a data-toggle="tab" href="#media">Images</a></li> 
                            <li id="ms-tab"><a data-toggle="tab" href="#ms">Milestones</a></li><?php
                       } ?> 
                   </ul> 
                </div>
                <div id="dtl-content" class="tab-content">
                    <div class="tab-pane active" id="course-tab-content"><br /><br /> 
                        @include('coach.pages.assigned_courses.details.general')
                    </div>
                   <?php 
                     if($id > 0){ ?>
                        <div class="tab-pane" id="media-tab-content"><br />
                            @include('coach.pages.assigned_courses.details.media')
                        </div>
                        <div class="tab-pane" id="ms-tab-content"><br />
                            @include('coach.pages.assigned_courses.details.milestones')
                        </div><?php
                     } ?> 
                </div>
                <hr />
                <div class="col-md-12 ">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2">{{ Form::button('Save', array('class' => 'btn btn-primary pull-right submit_btn', 'id'=>'submit_btn', 'type' => 'submit')) }}</div>
                        <a href="{{url('coach/assigned/courses')}}" class="p-2">{{ Form::button('Cancel', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a>
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
    
    $('#act-tab .nav-tabs li').on('click',function(){
        $('.nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active'); 
        $('.activity-content .tab-pane').removeClass('active'); $('.activity-content #content-'+this.id).addClass('active');
    });

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