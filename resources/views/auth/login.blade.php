@extends('admin.layouts.guest')
@section('title', 'Login')
@section('content')
    <!-- error page start //-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('images/admin/login/2.jpg') }}"
                                       alt="looginpage"/></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <form action="{{ route('login') }}" method="POST" class="theme-form login-form needs-validation"
                          novalidate="">
                        @csrf
                        <h4>Sign In</h4>
                        <h6>Welcome back! Sign in to your account.</h6>

                        @if($errors->any())
                            <div
                                class="alert alert-danger alert-dismissible fade show text-white py-2 px-3 d-flex align-items-center justify-content-between"
                                role="alert">
                                <span><strong>Oops!</strong> {{ $errors->first() }}</span>
                                <a href="#"><i class="fas fa-times text-white ps-3" data-bs-dismiss="alert"></i></a>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                       aria-label required placeholder="Jane@doe.com"/>
                                <div class="invalid-tooltip">Please enter a valid email.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required=""
                                       placeholder="*********" aria-label/>
                                <a href="javascript:void(0)" class="input-group-text">
                                    <i class="bi bi-eye-slash toggle-password"></i>
                                </a>
                                <div class="invalid-tooltip">Please enter password.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" name="remember"/>
                                <label class="text-muted" for="checkbox1">{{ __('Remember me') }}</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary btn-block" type="submit">Sign In</button>
                        </div>
                        <div class="login-social-title">
                            <h5>Sign In with</h5>
                        </div>
                        <div class="form-group">
                            <ul class="login-social">
                                <li>
                                    <a href="{{ route('auth.google') }}" target="_blank">
                                        <i class="bi bi-google"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/login" target="_blank">
                                        <i data-feather="github"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/login" target="_blank">
                                        <i data-feather="twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <p>Don't have account?<a class="ms-2" href="{{ route('admin.get.register') }}">Create
                                Account</a></p>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary fw-bold fs-13 py-2 px-3 position-fixed shadow-sm"
           style="bottom:1rem; left:1rem; border-radius: 20px">SAFIRI</a>
    </div>

    <script>
        (function () {
            "use strict";
            window.addEventListener(
                "load",
                function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    let forms = document.getElementsByClassName("needs-validation");
                    // Loop over them and prevent submission
                    let validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener(
                            "submit",
                            function (event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }

                                form.classList.add("was-validated");
                            },
                            false
                        );
                    });
                },
                false
            );
        })();
    </script>

@endsection
