@extends('layouts.master')
@section('title', 'Home')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}">
    <style>
        .swiper {
            height: 350px;
        }
    </style>
@endpush
@section('content')

    <div id="home">
        <div class="row justify-content-center py-4 banner-bg">
            @foreach($banners as $banner)
                <div class="col-md-4">
                    <div class="card py-5 px-4">
                        <div class="mb-md-5">
                            <h5>{{ $banner->title }}</h5>
                            <h4>{{ $banner->content }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="container listing my-3">
            <div class="row py-3">
                <div class="col-12 col-md-2">
                    <h6 class="fw-bold text-center">Best deals</h6>
                    <a href="{{ route('destinations.index') }}" class="btn btn-sm btn-outline-secondary mt-4">
                        See more <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="col-md-10 position-relative">
                    <!-- Slider main container -->
                    <button type="button" aria-label="previous" style="position:absolute;top:47%;left:-20px"
                            class="swiper-btn-prev carousel__back-button btn bg-transparent border-0 p-0">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach($destinations as $destination)
                                <div class="swiper-slide">
                                    <div class="card bg-transparent shadow">
                                        <img src="{{ gcs_asset("images/destinations/{$destination->image}") }}"
                                             class="card-img p-2"
                                             alt="...">
                                        <a href="{{ route('destinations.show', $destination->id) }}"
                                           class="card-img-overlay">
                                            @if($destination->id % 5 === 0)
                                                <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                                            @endif
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
                                                    @isset($destination->discount)
                                                        <del class="text-muted small">25,000</del>
                                                    @endisset
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

            <div class="row py-3">
                <div class="col-2">
                    <h6 class="fw-bold text-center">Most Popular</h6>
                    <a href="{{ route('destinations.index') }}" class="btn btn-sm btn-outline-secondary mt-4">
                        See more <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <div class="col-md-10 position-relative">
                    <!-- Slider main container -->
                    <button type="button" aria-label="previous" style="position:absolute;top:47%;left:-20px"
                            class="swiper-btn-prev carousel__back-button btn bg-transparent border-0 p-0">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach($destinations->shuffle() as $destination)
                                <div class="swiper-slide">
                                    <div class="card bg-transparent shadow">
                                        <img src="{{ asset("images/destinations/{$destination->image}") }}"
                                             class="card-img p-2"
                                             alt="...">
                                        <a href="{{ route('destinations.show', $destination->id) }}"
                                           class="card-img-overlay">
                                            @if($destination->id % 7 === 0)
                                                <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                                            @endif
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
                                                    @isset($destination->discount)
                                                        <del class="text-muted small">25,000</del>
                                                    @endisset
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

        <hr>

        <div class="container-fluid testimonials my-5">
            <div class="row px-md-5 mx-md-5">
                <div class="col">
                    <h5 class="ms-md-5">Our travellers' say...</h5>
                    <div class="row">
                        @foreach($testimonials as $testimonial)
                            <div class="col-xl-3 col-6 px-3 mb-3 position-relative">
                                <div class="card d-flex align-items-center bg-transparent p-4">
                                    <figure class="text-center">
                                        <small class="fw-bolder">{{ $testimonial->destination->name }}</small>
                                        <blockquote cite="https://www.huxley.net/bnw/four.html">
                                            <q>{{ $testimonial->comment }}</q>
                                        </blockquote>
                                        <figcaption class="text-muted">~ {{ $testimonial->name }},
                                            <cite>{{ $testimonial->created_at->diffForHumans() }}</cite></figcaption>
                                    </figure>
                                </div>
                                <div class="circle rounded-circle position-absolute"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="container listing my-3">
            <h5 class="mt-3">International</h5>
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
                            @foreach($destinations as $destination)
                                <div class="swiper-slide">
                                    <div class="card bg-transparent shadow">
                                        <img src="{{ asset("images/destinations/{$destination->image}") }}"
                                             class="card-img p-2"
                                             alt="...">
                                        <a href="{{ route('destinations.show', $destination->id) }}"
                                           class="card-img-overlay">
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
                                                    @isset($destination->discount)
                                                        <del class="text-muted small">25,000</del>
                                                    @endisset
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
            const swiperOptions = {
                // Optional parameters
                spaceBetween: 10,
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
            }

            const swiper = new Swiper('.swiper', {
                ...swiperOptions,
                slidesPerView: 2,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 4,
                    }
                },
            });
            const swiperIntl = new Swiper('.swiper.intl', {
                ...swiperOptions,
                slidesPerView: 2,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 4,
                    },
                    1024: {
                        slidesPerView: 5,
                    },
                },
            })
        </script>
    @endpush
@endsection
