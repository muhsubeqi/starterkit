@extends('layouts.simple')
@section('content')
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Reminder Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Forgot Password</h3>
                        <div class="block-options">
                            <a class="btn-block-option" href="{{ route('login') }}" data-bs-toggle="tooltip"
                                data-bs-placement="left" title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1">OneUI</h1>
                            <small class="fw-sm text-muted">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will
                                email you a password
                                reset link that will allow you to choose a new one.') }}
                            </small>
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <!-- Reminder Form -->
                            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-reminder mt-4" action="{{ route('password.email') }}"
                                method="POST">
                                @csrf
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg form-control-alt" id="email"
                                        name="email" placeholder="Email">
                                    @if ($errors->get('email'))
                                    @foreach ($errors->get('email') as $message)
                                    <small class="text-danger">{{ $message }}</small>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            <i class="fa fa-fw fa-envelope me-1 opacity-50"></i> {{ __('Email Password
                                            Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Reminder Form -->
                        </div>
                    </div>
                </div>
                <!-- END Reminder Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong>OneUI 5.5</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection