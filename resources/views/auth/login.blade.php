@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div id="admin" class="login-box" >
        <div class="logo-box text-center">
            <a href="{{url('/admin')}}" class="h1"><img loading="lazy"  style="width: 100%;" src="/images/aivine/adminLogo.png"/></a>
        </div>
        <p class="message">You are now logged out.</p>
        <div class="login-form">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <label for="user_login">Username or Email Address</label>
                    <input id="user_login" class="form-control @error('email') is-invalid @enderror" type="text"  name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="input-group mb-3" id="show_hide_password">
                    <label for="user_password">Password</label>
                    <div class="input-box">
                        <input id="user_password" class="form-control @error('password') is-invalid @enderror" type="password"  name="password" required>
                        <div class="input-group-append">
                            <button class="icon btn-hide-password">
                                <i class="fa fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="row">
                    <div class="col text-right" style="margin: 10px auto; display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <p class="backTo" style="margin: 20px auto;">
            <a href="{{ url('/') }}">← Go to Aivine</a>
        </p>
    </div>
@endsection
