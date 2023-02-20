@extends('layouts.app')
@section('title', 'Home')

@section('content')
<?php
if(Route::currentRouteName() == 'home'){
    ?>@include('includes.slider')<?php
    if($homeContents){ foreach($homeContents as $homeContent){ echo str_replace("{{ url('/') }}",$app['url']->to('/'),$homeContent->content); } }
}  ?> 
@endsection
