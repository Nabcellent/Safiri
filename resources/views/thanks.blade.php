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

        <div class="container listing my-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 fw-bold">Other destinations you may like:</h6>
                <a class="link-primary" href="{{ route('destinations.index') }}">
                    More destinations<i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="row py-3">
                <div class="col">
                    <!-- Slider main container -->
                    <button type="button" aria-label="previous" style="position:absolute;top:47%;left:-20px"
                            class="swiper-btn-prev carousel__back-button btn bg-transparent border-0 p-0">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="swiper intl">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach($suggestedDestinations as $destination)
                                <div class="swiper-slide">
                                    <div class="card bg-transparent shadow" style="width: 17rem;">
                                        <img src="{{ asset("images/destinations/{$destination->image}") }}"
                                             class="card-img p-2" alt="...">
                                        <a href="{{ route('destinations.show', $destination->id) }}" class="card-img-overlay">
                                            <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                                        </a>
                                        <div class="card-body position-relative">
                                            <a href="{{ route('destinations.show', $destination->id) }}">
                                                <h5 class="card-title fs-13 fw-bold"
                                                    style="height: 2rem">{{ $destination->name }}</h5>
                                            </a>
                                            <p class="card-text text-secondary small text-truncate mb-1">
                                                {{ $destination->vicinity }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div class="small fw-bold" style="height: 2rem">
                                                    <p class="mb-0">KSH.{{ number_format($destination->price) }}</p>
                                                    @if($destination->id === 2)
                                                        <del class="small">25,000</del>
                                                    @endif
                                                </div>
                                                <a href="{{ route('destinations.show.booking', ['id' => $destination->id]) }}"
                                                   class="btn btn-sm btn-primary fs-13 fw-bold rounded-3">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <button type="button" aria-label="next" style="position:absolute;top:47%;right:-20px"
                            class="swiper-btn-next btn bg-transparent border-0 p-0">
                        <i class="fas fa-arrow-right"></i>
                    </button>
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
