@extends('coach.layouts.app')
@section('title', 'Student')
@section('content')
<?php // echo '<pre>'; print_r($student); echo '</pre>';  echo 'ssss';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/courses')}}">Courses</a></li>
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
                       <li id="generel-tab" class="active"><a data-toggle="tab" href="#generel">Course</a></li>&nbsp;
                       <li id="media-tab"><a data-toggle="tab" href="#media">Media</a></li>
                       <li id="ms-tab"><a data-toggle="tab" href="#ms">Milestones / Activities</a></li>
                       <li id="students-tab"><a data-toggle="tab" href="#students">Students</a></li>
                   </ul>
                </div>
                <div id="dtl-content" class="tab-content"> 
                    <div class="tab-pane active" id="generel-tab-content"><br /><br />
                        @include('coach.pages.courses.details.general')
                    </div>
                    <div class="tab-pane" id="media-tab-content"><br /><br /> 
                        @include('coach.pages.courses.details.media')
                    </div>
                    <div class="tab-pane" id="ms-tab-content"><br /><br /> 
                        @include('coach.pages.courses.details.milestones')
                    </div>
                    <div class="tab-pane" id="students-tab-content"><br /><br /> 
                        @include('coach.pages.courses.details.students')
                    </div>
                </div>
                <hr />
                <div class="col-md-12 ">
                    <div class="d-flex flex-row-reverse">
                        <div class="p-2"><a href="{{url('/coach/courses')}}">{{ Form::button('Back', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
    $('#detail .nav-tabs li').on('click',function(){
        $('#detail .nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active');
        $('#dtl-content .tab-pane').removeClass('active'); $('#dtl-content #'+this.id+'-content').addClass('active');
    });
    
    $('#act-tab .nav-tabs li').on('click',function(){
        $('.nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active'); 
        $('.activity-content .tab-pane').removeClass('active'); $('.activity-content #content-'+this.id).addClass('active');
    });
    
});

function togleTab(tabId,id){
    $('#act-tab .nav-tabs li').removeClass('active'); $('#'+tabId).addClass('active'); 
    $('#activity-content-'+id+' .tab-pane').removeClass('active'); $('#activity-content-'+id+' #content-'+tabId).addClass('active');
}
</script>
@endsection