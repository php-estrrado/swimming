@extends('coach.layouts.app')
@section('title', 'Student')
@section('content')
<?php // echo '<pre>'; print_r($student); echo '</pre>';  echo 'ssss';
    $name           =   ($student)? $student->name : '';
    $phone          =   ($student)? $student->phone : ''; 
    $email          =   ($student)? $student->email : '';
    $address1       =   ($student)? $student->address1 : '';
    $address2       =   ($student)? $student->address2 : '';
    $active_from    =   ($student)? $student->active_from : '';
    $created_at     =   ($student)? $student->created_at : '';
    $status         =   ($student)? $student->active : 1;
    $reqd           =   '<span class="reqd">*</span>';
    if($student->avthar != NULL && $student->avthar != ''){ $avthar = url('storage'.$student->avthar); }else{ $avthar = url('storage/app/public/no_user.jpg'); }
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/students')}}">Students</a></li>
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
                           <li id="profile-tab" class="active"><a data-toggle="tab" href="#staff">Profile</a></li>&nbsp;
                           <li id="course-tab"><a data-toggle="tab" href="#wl">Courses</a></li>
                       </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile-tab-content"><br /><br /> 
                            @include('coach.pages.students.details.general')
                        </div>
                        <div class="tab-pane" id="course-tab-content"><br /><br /> 
                            @include('coach.pages.students.details.courses')
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12 ">
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2"><a href="{{url('/coach/students')}}">{{ Form::button('Back', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
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

});
</script>
@endsection