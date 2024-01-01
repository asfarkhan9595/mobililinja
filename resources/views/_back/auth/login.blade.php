@extends('layouts.back_auth')
@section('content')
<div class="auth-main">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);"><img src="{{ asset('_back/images/logo_login.png')}}"></a>
        </div>
        <div class="card">
            <div class="body">
                @include ('_back._inc.message')
                <p class="lead">Login to your account</p>
                <form class="form-auth-small m-t-20" method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" class="form-control" id="signin-email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Password</label>
                        <input type="password" class="form-control" id="signin-password" placeholder="Password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox">
                            <span>Remember me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-info btn-block">LOGIN</button>
                    <div class="bottom">
                        <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="password.html">Forgot password?</a></span>
                        <span>Don't have an account? <a href="register.html">Register</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
