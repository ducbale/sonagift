@extends('login')
@section('content')

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="@asset('assets/admin/img/illustrations/auth-login-illustration-light.png')" alt="auth-login-cover"
                         class="img-fluid my-5 auth-illustration"
                         data-app-light-img="illustrations/auth-login-illustration-light.png"
                         data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
                    <img src="@asset('assets/admin/img/illustrations/bg-shape-image-light.png')" alt="auth-login-cover"
                         class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                         data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <a href="{{url('index')}}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="@asset('assets/admin/img/avatars/nina.png')" alt class="h-auto" />
                            </span>
                        </a>
                    </div>
                    <h3 class="mb-1">Chào mừng bạn đến NiNa 👋</h3>
                    <p class="mb-4">Vui lòng đăng nhập vào tài khoản của bạn !</p>
                    <form id="loginadmin" method="post" action="{{ url('loginAdmin',null,['redirect'=>request()->query('redirect')]) }}" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   placeholder="Tài khoản" autofocus required />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Mật khẩu</label>
                            </div>
                            <div class="input-group input-group-merge" x-data="{ open: false }">
                                <input x-bind:type="(!open)?'password':'text'" id="password" class="form-control" name="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                       aria-describedby="password" required />
                                <span @click="open=!open" class="input-group-text cursor-pointer"><i class="ti" :class="(!open)?'ti-eye-off':'ti-eye'"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember-me">
                                <label class="form-check-label" for="remember-me"> Ghi nhớ đăng nhập </label>
                            </div>
                        </div>
                        <input name="csrf_token" type="hidden" value="{{ csrf_token() }}">
                        @if (!empty($mess))
                            <p class="messlogin">{{ $mess }}</p>
                        @endif
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
@pushonce('styles')
    <link rel="stylesheet" href="@asset('assets/admin/vendor/css/pages/page-auth.css')" />
@endpushonce
