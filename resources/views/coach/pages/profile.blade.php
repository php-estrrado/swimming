@extends('coach.layouts.app')
@section('title', 'Profile')
@section('content')
<!-- Page content -->
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">{{$profile->name}}</h2>
                </div>
                <div class="card-body">
                    <form id="profileform" name="profileform" method="POST" action="{{url('coach/profile/update')}}">
                        <div class="row">
                            {{ Form::open(array('url' => "profile/update", 'id' => 'profileForm', 'name' => 'profileForm', 'class' => '')) }}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('name', 'Name', ['class' => 'control-label',]) }}
                                        {{ Form::text('name', $profile->name, ['class' => 'form-control','id'=>'name']) }}
                                        @if ($errors->has('name'))<span class="error">{{ $errors->first('name') }}</span>@endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('phone', 'Phone', ['class' => 'control-label',]) }}
                                        {{ Form::text('phone', $profile->phone, ['class' => 'form-control','id'=>'phone']) }}
                                        @if ($errors->has('phone'))<span class="error">{{ $errors->first('phone') }}</span>@endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email', ['class' => 'control-label',]) }}
                                        {{ Form::text('email', $profile->email, ['class' => 'form-control','id'=>'email']) }}
                                        @if ($errors->has('email'))<span class="error">{{ $errors->first('email') }}</span>@endif
                                    </div>
                                     <div class="form-group">
                                        {{ Form::label('address', 'Address', ['class' => 'control-label',]) }}
                                        {{ Form::text('address1', $profile->address1, ['class' => 'form-control','id'=>'address1']) }}
                                        @if ($errors->has('address1'))<span class="error">{{ $errors->first('address1') }}</span>@endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Experience', 'Experience', ['class' => 'control-label',]) }}
                                        {{ Form::text('experience', $profile->experience, ['class' => 'form-control','id'=>'adress1']) }}
                                        @if ($errors->has('address1'))<span class="error">{{ $errors->first('address1') }}</span>@endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('curr_password', 'Current Password', ['class' => 'control-label',]) }}
                                        {{ Form::password('curr_password', ['class' => 'form-control','id'=>'curr_password']) }}
                                        @if ($errors->has('curr_password'))<span class="error">{{ $errors->first('curr_password') }}</span>@endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('password', 'Password', ['class' => 'control-label',]) }}
                                        {{ Form::password('password', ['class' => 'form-control','id'=>'password']) }}
                                        @if ($errors->has('password'))<span class="error">{{ $errors->first('password') }}</span>@endif
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'control-label',]) }}
                                        {{ Form::password('password_confirmation', ['class' => 'form-control','id'=>'password_confirmation']) }}
                                        @if ($errors->has('password_confirmation'))<span class="error">{{ $errors->first('password_confirmation') }}</span>@endif
                                    </div>
                                </div>
                            <div class="col-md-12">{{Form::submit('Update',['class'=>'btn btn-primary mt-1 mb-1 fr'])}}</div>
                            {{ Form::close() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

       
    </script>
    @endsection