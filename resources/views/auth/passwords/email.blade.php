@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
<section id="resetmail" class="section">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card reset">
                <div class="card-header">{{ __('Forgot Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        {{ Form::open(array('url' => "forgot/password", 'id' => 'forgotForm', 'name' => 'forgotForm', 'class' => '')) }}
                        <div class="form-group row">
                            <!--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            <div class="form-group row mb-0 text-center">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-theme">
                        {{ __('Send Password Reset Link') }}
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
@endsection
