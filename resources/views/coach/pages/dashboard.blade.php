@extends('coach.layouts.app') 
@section('title', 'Dashboard') 
@section('content')
<link rel="stylesheet" href="{{asset('public/shop/assets/css/chosen.css')}}">
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <!--        <li class="breadcrumb-item"><a href="<?php //echo $app['url']->to('/'.Session::get('companyName'))?>">Home</a></li>-->
        <li class="breadcrumb-item active" aria-current="page"></li>
    </ol>
</div>
<div class="container"> 
    <div class="card overflow-hidden">
        <div class="paddingleft">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 stats">
                    <div class="text-center">
                        <p class="text-light">
                            <i class="fa fa-users mr-2"></i> Total Students
                        </p>
                        <h2 class="text-yellow text-xxl">{{$total_students}}</h2>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                    <div class="text-center">
                        <p class="text-light">
                            <i class="fa fa-users mr-2"></i> Total Courses
                        </p>
                        <h2 class="text-yellow text-xxl">{{$total_course}}</h2>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                    <div class="text-center">
                        <p class="text-light">
                            <i class="fa fa-cart-arrow-down mr-2"></i> Completed Activities
                        </p>
                        <h2 class="text-warning text-xxl">{{$completed_task}}</h2>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                    <div class="text-center">
                        <p class="text-light">
                            <i class="fa fa-signal mr-2"></i> Pending Activities
                        </p>
                        <h2 class="text-danger text-xxl">{{$pending_task}} </h2>
                    </div>
                </div>
            </div>
        </div>
       <!-- <?php // echo '<pre>'; print_r($userData); echo '</pre>'; ?> -->
    </div>
</div>       
<script src="{{asset('public/shop/assets/js/chosen.jquery.js')}}"></script>
<script src="{{asset('public/shop/assets/js/init.js')}}"></script>
<style>.canvasjs-chart-credit{ display: none;} </style>
@endsection