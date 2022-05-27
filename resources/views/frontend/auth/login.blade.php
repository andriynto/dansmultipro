@extends('layouts.frontend.login')

@section('content')
<!-- Login form -->
<div class="card mb-0">
    <div class="card-header bg-primary-700" align="center">DANSMULTIPRO MONOLITE APPS </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <img src="{{ url('assets/images/logo/dans_logo_web.png') }}" style="width: 380px;">
        </div>

        <form action="{{ url('login') }}" class="login-form form-validate wmin-sm-400" method="post" accept-charset="utf-8">
            @csrf
            
            @include('flash::message')

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" maxlength="60" autocomplete="off" placeholder="Username / Email" required="">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                 </div>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" id="password" maxlength="40" autocomplete="off" placeholder="Kata Sandi" required="">
                <div class="form-control-feedback">
                   <i class="icon-key text-muted"></i>
                </div>
                @if($errors->has('password'))
                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                @endif
             </div>


             <div class="form-group d-flex align-items-center">
                <div class="form-check mb-0">
                    <label class="form-check-label">
                        <div class="uniform-checker" id="uniform-showPass">
                            <input name="remember_me" id="remember_me" type="checkbox" class="form-input-styled" autocomplete="off" data-fouc>
                        </div>
                        Ingatkan saya
                    </label>
                </div>
                <a href="{{ url('forget-password') }}" class="ml-auto">Forget Password?</a>
             </div>
             
             <div class="form-group">
                <button type="submit" id="submitsignin" class="btn btn-danger btn-block">Login</button>
             </div>

             <div class="form-group">
                <a href="{{ url('register') }}" id="register" class="btn btn-info btn-block">Register</a>
             </div>
        </form>
        <hr>
        <span class="form-text text-center text-muted">Get your software perfectly done by DAnS
        </span>
    </div>
</div>
<!-- /login form -->
@endsection