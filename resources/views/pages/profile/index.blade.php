@extends('layouts.backend')
@section('css')
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="module">
    @if(session('status') == 200)
        swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('message') }}',
            timer: 1000,
            showConfirmButton: false
        })
    @endif
</script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('media/photos/photo10@2x.jpg') }}');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center">
            <div class="my-3">
                @if ($user->image)
                <img class="img-avatar img-avatar-thumb" src="{{ asset('storage/images/user/' . $user->image) }}"
                    alt="">
                @else
                <img class="img-avatar img-avatar-thumb" src="{{ asset('media/avatars/avatar13.jpg') }}" alt="">
                @endif
            </div>
            <h1 class="h2 text-white mb-0">Edit Account</h1>
            <h2 class="h4 fw-normal text-white-75">
                {{ $user->name }}
            </h2>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">User Profile</h3>
        </div>
        <div class="block-content">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Your account’s vital info. Your username will be publicly visible.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="name">Username</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your username.." value="{{ old('name', $user->name) }}" required
                                autocomplete="name">
                            @if ($errors->get('name'))
                            @foreach ($errors->get('name') as $message)
                            <small class="text-danger">{{ $message }}</small>
                            @endforeach
                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email.." value="{{ old('email', $user->email) }}" required>
                            @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $message)
                            <small class="text-danger">{{ $message }}</small>
                            @endforeach
                            @endif
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                            $user->hasVerifiedEmail())

                            <small class="text-sm mt-2 text-danger">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="btn btn-sm btn-alt-primary">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </small>

                            @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                            @endif

                            @endif
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Your Avatar</label>
                            <div class="mb-4">
                                @if ($user->image)
                                <img class="img-avatar" src="{{ asset('storage/images/user/' . $user->image) }}" alt="">
                                @else
                                <img class="img-avatar" src="{{ asset('media/avatars/avatar13.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">Choose a new avatar</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END User Profile -->

    <!-- Change Password -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Change Password</h3>
        </div>
        <div class="block-content">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Changing your sign in password is an easy way to keep your account secure.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            @if ($errors->updatePassword->get('current_password'))
                            @foreach ($errors->updatePassword->get('current_password') as $message)
                            <small class="text-danger">{{ $message }}</small>
                            @endforeach
                            @endif
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label" for="update_password_password">New Password</label>
                                <input type="password" class="form-control" id="update_password_password"
                                    name="password">
                                @if ($errors->updatePassword->get('password'))
                                @foreach ($errors->updatePassword->get('password') as $message)
                                <small class="text-danger">{{ $message }}</small>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label" for="password_confirmation">Confirm New
                                    Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                                @if ($errors->updatePassword->get('password_confirmation'))
                                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                                <small class="text-danger">{{ $message }}</small>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Change Password -->

    <!-- Delete Account -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Delete Account</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.
                        Before deleting your account, please download any data or information that you wish to retain.')
                        }}
                    </p>
                </div>
                <div class="col-lg-8 col-xl-7">
                    <div class="row mb-4">
                        <div class="col-sm-10 col-md-8 col-xl-6">
                            <button type="button" class="btn w-100 btn-alt-danger text-start push"
                                data-bs-toggle="modal" data-bs-target="#confirm-user-deletion"><i
                                    class="fas fa-user opacity-50 me-1"></i> Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Delete Account -->

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog"
        aria-labelledby="confirm-user-deletion" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="block block-rounded block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">{{ __('Are you sure you want to delete your account?') }}</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content fs-sm mb-3">
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently
                                deleted. Please enter your password to confirm you would like to permanently delete your
                                account.') }}
                            </p>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password" required>
                            @if ($errors->userDeletion->get('password'))
                            @foreach ($errors->userDeletion->get('password') as $message)
                            <small class="text-danger">{{ $message }}</small>
                            @endforeach
                            @endif
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection