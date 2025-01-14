@extends('backend.layouts.external')

@section('title')
    Login
@endsection
@section('main-content')
    <div class="custom-login">
        <!-- Demo content-->
        <div class="custom-login-box">

            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="mb-5 d-flex">
                <a href="#" class="header-logo"><img
                        src="{{ asset('backpanel/assets/images/brand-logos/desktop-logo.png') }}" class="desktop-logo ht-40"
                        alt="logo">
                </a>
            </div>
            <div class="main-signup-header">
                <h6 class="fw-medium mb-4 fs-17">Sign in</h6>
                <form action="{{ route('loginuser') }}"id="login-form" method="POST" class="login-form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control email" placeholder="Enter your email" type="text" name="email"
                            id="email">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control password" placeholder="Enter your password" type="password"
                            name="password" id="password">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <div class="row ms-0">
                            <div class="form-check col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input class="form-check-input" type="checkbox" value="" id="show-password">
                                <label class="form-check-label" for="show-password">
                                    Show Password
                                </label>
                            </div>
                            <a href="{{ route('admin.forgotpassword') }}"
                                class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 text-end">
                                <label class="form-check-label ">
                                    Forgot Password
                                </label>

                            </a>
                        </div>
                    </div>
                    <button type="button" id="signin-btn" class="btn btn-primary btn-block w-100">Sign
                        In</button>
                </form>
            </div>
        </div><!-- End -->
    </div>
@endsection
@section('scripts')
    <script>
        $("#login-form").validate({
            rules: {

                email: {
                    required: true
                },
                password: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter email",
                },
                password: {
                    required: "Please enter password.",
                },
            },
            highlight: function(element) {
                $(element).addClass('border-danger');
            },
            unhighlight: function(element) {
                $(element).removeClass('border-danger');
            },
        });
        $(document).ready(function() {
            $('#signin-btn').off('click');
            $('#signin-btn').on('click', function() {

                if ($('#login-form').valid()) {
                    $('#signin-btn').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i> Loading...');
                    $('#login-form').ajaxSubmit(function(response) {

                        var result = JSON.parse(response);
                        if (result) {
                            showNotification(result.message, result.type);
                            if (result.type === 'success') {
                                window.location.href = result.url;
                                $('#login-form')[0].reset();
                            } else {

                                $('#signin-btn').prop('disabled', false).html('Sign In');
                            }
                        }
                    });
                }
            });
        });

        // Show password-start
        $('#show-password').off('change');
        $('#show-password').on('change', function() {
            var passwordField = $('#password');
            if (passwordField.prop('type') == 'password') {
                passwordField.prop('type', 'text');
            } else {
                passwordField.prop('type', 'password');
            }
        });
        // Show password-end
    </script>
@endsection
