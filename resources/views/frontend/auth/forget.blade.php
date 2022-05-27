@extends('layouts.frontend.login')

@section('content')
<!-- Login form -->
<div class="card mb-0">
    <div class="card-header bg-primary-700" align="center">DANSMULTIPRO MONOLITE APPS </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <i class="icon-lock2 icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
            <h5 class="mb-0">Lupa Kata Sandi</h5>
        </div>

        @include('flash::message')

        <form action="{{ url('forget-password') }}" class="login-form form-validate wmin-sm-400" method="post" accept-charset="utf-8">
            @csrf
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="40" autocomplete="off" placeholder="Email" required="">
                <div class="form-control-feedback">
                    <i class="icon-envelope text-muted"></i>
                 </div>
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             <div class="form-group">
                <button type="submit" id="submitsignin" class="btn btn-primary btn-block">Kirim</button>
             </div>

             <div class="form-group">
                <a href="{{ url('login') }}" class="btn btn-warning btn-block">Kembali Login</a>
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