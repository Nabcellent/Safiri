@extends('layouts.master')
@section('title', 'Destinations')
@section('content')

    <div id="destinations">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Domestic deals</li>
            </ol>
        </nav>

        <div class="row justify-content-center banner-bg">
            <div class="card bg-dark border-0 text-white mb-0">
                <img src="{{ asset('images/admin/big-masonry/7.jpg') }}" class="card-img" alt="...">
                <div class="card-img-overlay justify-content-center d-flex align-items-center">
                    <div class="text-center">
                        <h5 class="card-title">Domestic deals</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta doloremque et
                            facere facilis harum ipsam itaque laudantium nesciunt nostrum, odit quaerat reprehenderit
                            sequi
                            veritatis voluptas voluptatum! Illum quaerat quasi vitae.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container listing mb-3">
            <div class="row justify-content-end">
                <h1 class="col-auto">
                    <a href="javascript:void(0)" class="fas fa-th-large display"></a>
                    <a href="javascript:void(0)" class="fas fa-bars display"></a>
                </h1>
            </div>
            <div class="row position-relative">
                @include('partials.filters')

                <div class="col-md-9">

                    <livewire:search-destination />

                </div>
            </div>
        </div>

        <hr>
    </div>

    <script>
        $('.display').on('click', function() {
            if($(this).hasClass('fa-th-large')) {
                $('.listing-item .body').addClass('col-lg-6')
                $('.listing-item .image').addClass('col-lg-12')
                $('.listing-item .image img').css('height', '275px')
                $('.listing-item .text').addClass('col-lg-12')
                $('.listing-item .text .card-body').addClass('pt-2')
                $('.listing-item .text-child').addClass('col-lg-6')
                $('.listing-item .col-7.text-child').addClass('d-flex justify-content-between flex-column')

                $('.listing-item .description').addClass('d-none')
            } else {
                $('.listing-item .body').removeClass('col-lg-6')
                $('.listing-item .image').removeClass('col-lg-12')
                $('.listing-item .image img').css('height', '245px')
                $('.listing-item .text').removeClass('col-lg-12')
                $('.listing-item .text .card-body').removeClass('pt-2')
                $('.listing-item .text-child').removeClass('col-lg-6')
                $('.listing-item .col-7.text-child').removeClass('d-flex justify-content-between flex-column')

                $('.listing-item .description').removeClass('d-none')
            }
        })
    </script>
@endsection
