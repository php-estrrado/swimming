@extends('coach.layouts.app')
@section('title', 'Session Request')
@section('content')
<?php // echo '<pre>'; print_r($course); echo '</pre>'; 
    $student        =   ($session)? $session->name : '';
    $coach          =   ($session)? $session->coach : ''; 
    $actCode        =   ($session)? $session->activity_code : '';
    $actName        =   ($session)? $session->activity_name : '';
    $description    =   ($session)? $session->description : '';
    $review         =   ($session)? $session->review : '';
    $submited       =   ($session)? $session->submited_at : '';
    $status         =   ($session)? $session->act_status : 'Pending';
    $reqd           =   '<span class="reqd">*</span>';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/activity/session/requests')}}">Session Requests</a></li>
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
                {{ Form::open(array('url' => "coach/activity/session/save", 'id' => 'sessionForm', 'name' => 'sessionForm', 'class' => '','files'=>'true')) }}
                    {{Form::hidden('rId', $id)}}
                    <div class="tab-content">
                        <div class="tab-pane active" id="course-tab-content"><br /><br /> 
                            @include('coach.pages.session.details.general')
                        </div>
                       
                    </div>
                    <hr />
                    <div class="col-md-12 ">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">{{ Form::button('Save', array('class' => 'btn btn-primary pull-right submit_btn', 'type' => 'submit')) }}</div>
                            <div class="p-2"><a href="{{url('/coach/activity/session/requests')}}">{{ Form::button('Cancel', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
                        </div>
                    </div>
                {{ Form::close() }}  
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
</script>
@endsection