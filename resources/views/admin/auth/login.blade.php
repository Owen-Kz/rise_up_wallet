@extends('admin.auth.layouts.auth-master')

@section('section')
    <div class="account-wrapper">
        <div class="account-header">
            <div class="site-logo">
                <img src="{{ get_logo($basic_settings) }}" alt="logo">
            </div>
            <span class="inner-title">👋</span>
            <h6 class="sub-title">{{ __("Welcome To") }} <span>{{ __("Admin Panel") }}</span></h6>
        </div>
        <form class="account-form" action="{{ setRoute('admin.login.submit') }}" method="POST">
            @csrf
            @php
                env("APP_MODE") == 'demo' ? $email = "superadmin@babia.to": $email= "";
                env("APP_MODE") == 'demo' ? $password = "appdevs": $password= "";
            @endphp
            <div class="form-group">
                <input type="text" class="@error('email') is-invalid @enderror" title="Enter Username" required name="email" value="{{ old('email') ?? $email ?? "" }}" autofocus>
                <label>{{ __("Email Address") }}</label>

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group show_hide_password">
                <input type="password" title="Enter password" required name="password" value="{{ $password ?? "" }}">
                <button type="button" class="show-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                <label>{{ __("Password") }}</label>
            </div>
            <div class="form-group">
                <div class="forgot-item">
                    <p><a href="{{ setRoute('admin.password.forgot') }}" class="text--base">{{ __("Forgot Password?") }}</a></p>
                </div>
            </div>
            <button type="submit" class="btn--base w-100 btn-loading">{{ __("Login") }}</button>
        </form>
    </div>
@endsection