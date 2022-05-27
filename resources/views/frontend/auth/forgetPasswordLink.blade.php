@extends('layouts.frontend.login')

@section('content')
<!-- Login form -->
<div class="card mb-0">
    <div class="card-header bg-primary-700" align="center">DANSMULTIPRO MONOLITE APPS </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <i class="icon-lock2 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
            <h5 class="mb-0">Reset Kata Sandi</h5>
        </div>

        @include('flash::message')

        <form action="{{ route('reset.password.post') }}" class="login-form form-validate wmin-sm-400" method="post" accept-charset="utf-8">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="40" autocomplete="off" placeholder="Email" required="">
                <div class="form-control-feedback">
                    <i class="icon-envelope text-muted"></i>
                 </div>
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" maxlength="40" autocomplete="off" placeholder="Kata Sandi" required="">
                <div class="form-control-feedback">
                    <i class="icon-key text-muted"></i>
                 </div>
                 @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" maxlength="40" autocomplete="off" placeholder="Konfirmasi Kata Sandi" required="">
                <div class="form-control-feedback">
                    <i class="icon-key text-muted"></i>
                 </div>
                 @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" id="submitsignin" class="btn btn-warning btn-block">Reset Kata Sandi</button>
            </div>
        </form>
        <hr>
        <span class="form-text text-center text-muted">Get your software perfectly done by DAnS
            <br>DAnS Monolite Apps
        </span>
    </div>
</div>
<!-- /login form -->
@endsection