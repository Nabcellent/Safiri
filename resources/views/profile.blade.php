@extends('layouts.master')
@section('title', 'Profile')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
@endpush
@section('content')

    <div id="thanks">
        <div class="container listing my-3">
            <div class="card my-5 py-5 bg-transparent">
                <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('images/spot-illustrations/corner-2.png') }});"></div>
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col text-center">
                            Total Bookings - {{ $user->bookings_count }}
                        </div>
                        <div class="col text-center">
                            Total Reviews - {{ $user->reviews_count }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-5 py-4 px-5" style="background-color: #24695c">
                <div class="bg-holder d-none d-lg-block bg-card"
                     style="background-image:url({{ asset('images/spot-illustrations/corner-4.png') }});"></div>
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col text-light text-center">
                            <h3>My profile</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="#" method="POST" class="row text-light">
                                @csrf @method('PUT')
                                <div class="col-6 mb-3">
                                    <small>First name</small>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ old('first_name', $user->first_name) }}" aria-label required>
                                </div>
                                <div class="col-6 mb-3">
                                    <small>Last name</small>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name', $user->last_name) }}" aria-label required>
                                </div>
                                <div class="col-4 mb-3">
                                    <small>Email</small>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                           aria-label readonly>
                                </div>
                                <div class="col-4 mb-3">
                                    <small>Gender</small>
                                    <input type="text" class="form-control" name="gender"
                                           value="{{ ucfirst($user->gender) }}" aria-label readonly>
                                </div>
                                <div class="col-4 mb-3">
                                    <small>Phone number</small>
                                    <input type="text" class="form-control" name="phone" aria-label
                                           value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-outline-light">Update profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-lg-5">
                        <div class="col text-light text-center">
                            <h3>Change password</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="#" method="POST" class="row text-light">
                                @csrf @method('PUT')
                                <div class="col-12 mb-3">
                                    <small>Current password</small>
                                    <input type="password" class="form-control" name="first_name" aria-label required>
                                </div>
                                <div class="col-6 mb-3">
                                    <small>New password</small>
                                    <input type="password" class="form-control" name="last_name" aria-label required>
                                </div>
                                <div class="col-6 mb-3">
                                    <small>Confirm password</small>
                                    <input type="password" class="form-control" name="email" aria-label required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-outline-light">Update password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/swiper/swiper.min.js') }}"></script>
        <script>
            const swiperIntl = new Swiper('.swiper.intl', {
                // Optional parameters
                slidesPerView: 5,
                spaceBetween: 30,
                grabCursor: true,
                loop: true,

                autoplay: {
                    delay: 7000,
                    disableOnInteraction: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-btn-next',
                    prevEl: '.swiper-btn-prev',
                },
            })

        </script>
    @endpush
@endsection
