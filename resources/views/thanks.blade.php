@extends('layouts.master')
@section('title', 'Thanks')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
@endpush
@section('content')

    <div id="thanks">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thank You</li>
            </ol>
        </nav>

        <div class="card my-5 py-5" style="background-color: #24695c">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{ asset('images/spot-illustrations/corner-4.png') }});"></div>
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col text-light text-center">
                        <h1><i class="fas fa-check-circle text-success"></i></h1>
                        <p>Congratulations, your booking has been successful. We shall keep in touch😁</p>
                        <h3>Thank you!</h3>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.suggest_destinations')
    </div>
@endsection
