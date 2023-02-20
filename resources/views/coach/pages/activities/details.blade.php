@extends('coach.layouts.app')
@section('title', 'Student')
@section('content')
<?php // echo '<pre>'; print_r($student); echo '</pre>';  echo 'ssss';
    if($activity->act_status > 2){ $resp = true; }else{ $resp = false; }
    $reqd           =   '<span class="reqd">*</span>';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/submitted/activities')}}">Submitted Activities</a></li>
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
                    <div class="">
                        <ul class="nav nav-tabs">
                           <li id="general-tab" class="active"><a data-toggle="tab" href="#general">Profile</a></li>&nbsp;
                           <li id="media-tab"><a data-toggle="tab" href="#media">Media</a></li>
                       </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general-tab-content"><br /><br /> 
                            @include('coach.pages.activities.details.general')
                        </div>
                        <div class="tab-pane" id="media-tab-content"><br /><br /> 
                            @include('coach.pages.activities.details.media')
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12 ">
                        <div class="d-flex flex-row-reverse row">
                            @if(!$resp)<div class="p-2">{{ Form::button('Save', array('id'=>'submit_btn','class' => 'btn btn-primary pull-right submit_btn', 'type' => 'button')) }}</div> @endif
                            <div class="p-2"><a href="{{url('/coach/submitted/activities')}}">{{ Form::button('Back', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
    $('.nav-tabs li').on('click',function(){
        $('.nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active');
        $('.tab-content .tab-pane').removeClass('active'); $('.tab-content #'+this.id+'-content').addClass('active');
    });
    $('#submit_btn').on('click',function(){
        $('#reviewForm').submit(); 
    });

});
</script>
@endsection