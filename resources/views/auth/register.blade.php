@extends('admin.layouts.guest')
@section('title', 'Register')
@section('content')
    <!-- error page start //-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <form action="{{ route('register') }}" method="POST" class="theme-form login-form needs-validation"
                          novalidate>
                        <h4>Create your account</h4>
                        <h6>Enter your personal details to create account</h6>
                        <div class="form-group">
                            <label>Your Name</label>
                            <div class="small-group">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" required placeholder="First Name"
                                           name="first_name"
                                           value="{{ old('first_name', $googleUser->user['given_name'] ?? '') }}"
                                           aria-label=""/>
                                    <div class="invalid-tooltip">First name is required</div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" required placeholder="Last Name"
                                           name="last_name"
                                           value="{{ old('last_name', $googleUser->user['family_name'] ?? '') }}"
                                           aria-label/>
                                    <div class="invalid-tooltip">Last name is required</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" required placeholder="Test@gmail.com"
                                       value="{{ old('first_name', $googleUser->email ?? '') }}" aria-label/>
                                <div class="invalid-tooltip">Please enter a valid email.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required
                                       placeholder="*********" aria-label/>
                                <div class="show-hide"><span class="show"> </span></div>
                                <div class="invalid-tooltip">Password is required.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox"/>
                                <label class="text-muted" for="checkbox1">Agree with<span>Privacy Policy </span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="google_id" value="{{ old('google_id', $googleUser->id ?? '') }}">
                            <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                        </div>
                        <div class="login-social-title">
                            <h5>Sign Up with</h5>
                        </div>
                        <div class="form-group">
                            <ul class="login-social">
                                <li>
                                    <a href="https://www.linkedin.com/login" target="_blank">
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
                        <p>Already have an account?<a class="ms-2" href="{{ route('admin.get.login') }}">Sign in</a></p>
                    </form>
                </div>
            </div>
            <div class="col-xl-7 p-0">
                <img class="bg-img-cover bg-center" src="{{ asset('images/admin/login/1.jpg') }}" alt="looginpage"/>
            </div>
        </div>
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
