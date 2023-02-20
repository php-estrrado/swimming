@extends('layouts.app')
@section('title', 'Register')
@section('content')
@php $locations = App\Models\User::getLocations(); @endphp
<div class="secsep">&nbsp;</div>
<section id="secreg" class="section mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-12 offset-md-4 reg_bg">
                <div class="panel panel-default">
                    <h2 class="panel-heading mb-4 mt-4 text-center text-red" style="font-size:1.6rem;">REGISTER</h2>
                        <div class="panel-body">
                            {{ Form::open(array('url' => 'user/register', 'id' => 'signUpForm', 'name' => 'signUpForm', 'class' => '')) }}
                            {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                                        {{ Form::hidden('user_type', '1') }}
                                        {{ Form::text('name', '', ['class' => 'form-control']) }}
                                        @if ($errors->has('name'))
                                        <span class="error">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                   <div class="col-md-12">
                                        {{ Form::label('email', 'Email Address', ['class' => 'control-label']) }}
                                        {{ Form::email('email', '', ['class' => 'form-control']) }}
                                        @if ($errors->has('email'))
                                        <span class="error">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        {{ Form::label('phone', 'Phone Number', ['class' => 'control-label']) }}
                                        {{ Form::text('phone', '', ['class' => 'form-control']) }}
                                        @if ($errors->has('phone'))
                                        <span class="error">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        {{ Form::label('location', 'Location', ['class' => 'control-label']) }}
                                        {{ Form::select('location', $locations,'', ['class' => 'form-control','placeholder'=>'Select Location']) }}
                                        @if ($errors->has('location'))
                                        <span class="error">{{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        {{ Form::label('experience', 'Years of Experience ', ['class' => 'control-label']) }}
                                        {{ Form::text('experience', '', ['class' => 'form-control']) }}
                                        @if ($errors->has('experience'))
                                        <span class="error">{{ $errors->first('experience') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                                        {{ Form::password('password', ['class' => 'form-control']) }}
                                        @if ($errors->has('password'))
                                            <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                         {{ Form::label('password-confirm', 'Confirm Password', ['class' => 'control-label']) }}
                                         {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-theme btn-blk mt-2">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                       </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function blockSpecialChar(event) {
            var key;
            document.all ? key = event.keyCode : key = event.which;
            return ((key > 64 && key < 91) || (key > 96 && key < 123) || key == 8 || key == 32 || (key >= 48 && key <= 57));
        }
    $(document).ready(function(){
        $('.input-phone').intlInputPhone(
            
        );
        $('#btn-country .caret').hide();
        $('#btn-country').on('click',function(){
            $('.dropdown-menu').show();
        });
        $('.dropdown-menu a.country').on('click',function(){
            $('.dropdown-menu').hide();
        });
    });
</script>
@endsection



