@extends('admin.layouts.guest')
@section('title', 'Register')
@section('content')

    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <form action="{{ route('register') }}" method="POST" class="theme-form login-form needs-validation"
                          novalidate>@csrf
                        <h4>Create your account</h4>
                        <h6>Enter your personal details to create account</h6>

                        @if($errors->any())
                            <div
                                class="alert alert-danger alert-dismissible fade show text-white py-2 px-3 d-flex align-items-center justify-content-between"
                                role="alert">
                                <span><strong>Oops!</strong> {{ $errors->first() }}</span>
                                <a href="#"><i class="fas fa-times text-white ps-3" data-bs-dismiss="alert"></i></a>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col form-group">
                                <small>First name</small>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                    <input class="form-control" type="text" required placeholder="First Name"
                                           name="first_name"
                                           value="{{ old('first_name', $googleUser->user['given_name'] ?? '') }}"
                                           aria-label=""/>
                                    <div class="invalid-tooltip">First name is required</div>
                                </div>
                            </div>
                            <div class="col form-group">
                                <small>Last name</small>
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
                            <small>Email Address</small>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" required
                                       placeholder="John@doe.com"
                                       value="{{ old('email', $googleUser->email ?? '') }}" aria-label/>
                                <div class="invalid-tooltip">Please enter a valid email.</div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-auto">
                                <div class="input-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                               value="male"
                                               @if(old('gender') === "male") checked @endif required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                               value="female"
                                               @if(old('gender') === "female") checked @endif required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <small>Password</small>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password" required
                                           placeholder="*********" aria-label/>
                                    <a href="javascript:void(0)" class="input-group-text">
                                        <i class="bi bi-eye-slash toggle-password"></i>
                                    </a>
                                    <div class="invalid-tooltip">Confirmation password is required.</div>
                                </div>
                            </div>
                            <div class="col form-group">
                                <small>Confirm password</small>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" type="password" name="password_confirmation" required
                                           placeholder="*********" aria-label/>
                                    <a href="javascript:void(0)" class="input-group-text">
                                        <i class="bi bi-eye-slash toggle-password"></i>
                                    </a>
                                    <div class="invalid-tooltip">Password is required.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="agree" type="checkbox"/>
                                <label class="text-muted" for="agree">Agree with<span> Privacy Policy</span>.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="google_id" value="{{ old('google_id', $googleUser->id ?? '') }}">
                            <button class="btn btn-sm btn-primary btn-block" type="submit">Create Account</button>
                        </div>
                        <div class="login-social-title">
                            <h5>Sign Up with</h5>
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
                        <p>Already have an account?<a class="ms-2" href="{{ route('admin.get.login') }}">Sign in</a></p>
                    </form>
                </div>
            </div>
            <div class="col-xl-7 p-0">
                <img class="bg-img-cover bg-center" src="{{ asset('images/admin/login/1.jpg') }}" alt="looginpage"/>
            </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-primary fw-bold fs-13 py-2 px-3 position-fixed shadow-sm"
           style="bottom:1rem; right:1rem; border-radius: 20px">SAFIRI</a>
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
