@extends('layouts.frontend.login')

@section('content')
<!-- /Registration form -->
<div class="card mb-0">
    <div class="card-header bg-primary-700" align="center">DANSMULTIPRO MONOLITE APPS </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <img src="{{ url('assets/images/logo/dans_logo_web.png') }}" style="width: 380px;">
        </div>

        @include('flash::message')

        <form action="{{ url('register') }}" class="login-form form-validate wmin-sm-400" method="post" accept-charset="utf-8">
            @csrf
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                Registration Account. <a href="#" class="alert-link">password will be sent to email</a>.
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" maxlength="60" autocomplete="off" placeholder="Fullname" required="">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                 </div>
                 @if($errors->has('name'))
                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="" maxlength="60" autocomplete="off" placeholder="Username" required="">
                <div class="form-control-feedback">
                    <i class="icon-user-check text-muted"></i>
                 </div>
                 @if($errors->has('username'))
                    <span class="invalid-feedback">{{ $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="andrims21@gmail.com" maxlength="60" autocomplete="off" placeholder="Email" required="">
                <div class="form-control-feedback">
                    <i class="icon-envelope text-muted"></i>
                 </div>
            </div>
            
             
            <div class="form-group">
            <button type="submit" id="submitRegister" class="btn btn-danger btn-block">Register</button>
            </div>

            <div class="form-group">
            <a href="{{ url('login') }}" id="register" class="btn btn-info btn-block">Back to Login</a>
            </div>
        </form>
        <hr>
        <span class="form-text text-center text-muted">Get your software perfectly done by DAnS
        </span>
    </div>
</div>
<!-- /Registration form -->
@endsection