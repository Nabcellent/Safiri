@extends('layouts.master')
@section('title', 'Booking')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/intltelinput/intlTelInput.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style>
        .iti {
            width: 100%;
        }
        input[name="email"],
        input[name="phone"],
        input[name="dates"] {
            padding: 1rem 1.3rem;
            border-radius: 17px;
        }
    </style>
@endpush
@section('content')

    <div id="details">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maasai Mara trip package</li>
                <li class="breadcrumb-item active" aria-current="page">Booking</li>
            </ol>
        </nav>

        <div class="container px-xl-5">
            <div class="row px-xl-5">
                <form class="col">
                    <div class="row mb-3">
                        <div class="form-group col">
                            <label class="small">Phone number *</label>
                            <input type="tel" id="phone" class="form-control form-control-lg" name="phone"
                                   placeholder="Phone number*"
                                   aria-label required>
                            <div id="phone-error-message" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group col">
                            <label class="small">Email</label>
                            <input type="email" id="email" class="form-control form-control-lg" name="email"
                                   placeholder="Email address (optional)"
                                   aria-label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small">Range of dates*</label>
                        <input class="datepicker-here form-control form-control-lg digits" type="text" name="dates"
                               placeholder="Range of dates*" data-range="true" data-multiple-dates-separator=" - "
                               data-language="en" aria-label/>
                        <div id="phone-error-message" class="invalid-feedback"></div>
                    </div>

                    <hr class="my-4">

                    <div class="card-body megaoptions-border-space-sm bg-transparent">
                        <div class="mega-inline d-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card mb-0">
                                        <div class="media p-20">
                                            <div class="radio radio-primary me-3">
                                                <input id="radio14" type="radio" name="radio1" value="option1" />
                                                <label for="radio14"></label>
                                            </div>
                                            <div class="media-body">
                                                <div class="mt-0 mega-title-badge d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="small mb-0">MPESA</p>
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>
                                                    <span class="badge badge-primary pull-right digits">KSH.2,837.50</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card mb-0">
                                        <div class="media p-20">
                                            <div class="radio radio-secondary me-3">
                                                <input id="radio13" type="radio" name="radio1" value="option1" />
                                                <label for="radio13"></label>
                                            </div>
                                            <div class="media-body">
                                                <div class="mt-0 mega-title-badge d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="small mb-0">PayPal</p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061zM6.543 8.82l-.845 5.213v.001l-.208 1.32c-.01.066.04.123.105.123H8.14c.173 0 .32-.125.348-.296v-.005l.026-.129.48-3.043.03-.164a.873.873 0 0 1 .862-.734h.38c1.201 0 2.24-.244 3.043-.815.797-.567 1.39-1.477 1.663-2.874.229-1.175.096-2.087-.45-2.71a2.126 2.126 0 0 0-.548-.438l-.003.016c-.645 3.312-2.853 4.456-5.672 4.456H6.864a.695.695 0 0 0-.321.079z"/>
                                                        </svg>
                                                    </div>
                                                    <span class="badge badge-secondary pull-right digits">$ 2.8</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col">
                            <section>
                                <div class="_kcwzmp"><h4 tabindex="-1" class="fw-bolder">Cancellation policy</h4></div>
                            </section>
                            <strong id="CANCELLATION_POLICY-title">Free cancellation before 3:00 PM on Nov
                                25.</strong><span> <span>After that, cancel before 3:00 PM on Nov 26 and get a full refund, minus the service fee.</span> </span>
                        </div>
                    </div>

                    <div style="margin-top: 20px; --gp-section-top-margin:24;">
                        <div style="padding-top: 24px; padding-bottom: 24px;">
                            <div class="_n6ouu8">By selecting the button below, I agree to all the
                                <span role="button" class="text-underline">Rules</span>,
                                <a target="_blank" href="#">Safiri's COVID-19 Safety Requirements</a> and the
                                <span role="button">Guest Refund Policy</span>.
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-block btn-primary">Confirm and pay</button>
                    </div>
                </form>

                <div class="col-5">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <img src="{{ asset('images/admin/big-masonry/7.jpg') }}"
                                 class="img-fluid rounded-circle shadow p-2"
                                 style="object-fit:cover;width:10rem; height:10rem" alt="">
                        </div>
                        <div class="col">
                            <h6 class="fw-bold">Maasai Mara Trip Package</h6>
                            <p>--- rating and reviews---</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row mb-3">
                        <div class="col card-body border shadow-sm p-4" style="border-radius:20px">
                            <h5>Total cost summery</h5>
                            <ul class="list-group-flush">
                                <li class="list-group-item bg-transparent d-flex row">
                                    <small class="col">(Price per {night} - KSH.700) * 4</small>
                                    <small class="col">KSH.2,800.00</small>
                                </li>
                                <li class="list-group-item bg-transparent d-flex row">
                                    <small class="col">Service charge</small>
                                    <small class="col">KSH.37.50</small>
                                </li>
                                <li class="list-group-item bg-transparent d-flex row fw-bolder">
                                    <small class="col">Total</small>
                                    <small class="col">KSH.2,837.50</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/intltelinput/intlTelInput-jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/intltelinput/intlTelInput.min.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="{{ asset('vendor/viho/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
        <script>
            let input = document.querySelector("#phone");

            // here, the index maps to the error code returned from getValidationError - see readme
            let errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

            // initialise plugin
            let iti = window.intlTelInput(input, {
                utilsScript: "{{ asset('vendor/intltelinput/utils.js') }}"
            });

            iti.setCountry("ke");

            let reset = function () {
                $(input).removeClass("is-valid").removeClass('is-invalid');
            };

            // on blur: validate
            input.addEventListener('blur', function () {
                reset();
                if (input.value.trim()) {
                    if (iti.isValidNumber()) {
                        $(input).addClass("is-valid").removeClass('is-invalid');
                        $('#phone-error-message').hide(100)
                    } else {
                        $(input).addClass("is-invalid").removeClass('is-valid');
                        let errorCode = iti.getValidationError();
                        console.log(iti.getValidationError())
                        console.log(errorMap[errorCode])
                        $('#phone-error-message').html(errorMap[errorCode] ?? 'Invalid number').show(200);
                    }
                }
            });

            // on keyup / change flag: reset
            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);
        </script>

        {{--<script>
            $('input[name="dates"]').daterangepicker();
        </script>--}}
    @endpush
@endsection
