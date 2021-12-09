@extends('layouts.master')
@section('title', 'Details')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
@endpush
@section('content')

    <div id="details">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Destinations</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $destination->name }}</li>
            </ol>
        </nav>

        <div class="container-fluid px-lg-10 main-swiper">
            <div class="row px-lg-10">
                <div class="col">
                    <div class="swiper mainSwiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img src="{{ asset("images/destinations/{$destination->image}") }}" alt="Destination img">
                            </div>
                            @foreach($destination->destinationImages as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset("images/destinations/$image->image") }}" alt="Destination img">
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div thumbsSlider="" class="swiper thumbSwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset("images/destinations/{$destination->image}") }}" alt="Destination img"/>
                            </div>
                            @foreach($destination->destinationImages as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset("images/destinations/$image->image") }}" alt="Destination img"/>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="row mb-5">
                        <div class="col">
                            <h3>{{ $destination->name }}</h3>
                            <p>--- rating: {{ $destination->rating }} ---</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <ul class="col-xxl-8 list-group-flush">
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Type</div>
                                <div class="col">{{ ucwords(str_replace('_', ' ', $destination->category->title)) }}</div>
                            </li>
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Availability</div>
                                <div class="col">Available</div>
                            </li>
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Location</div>
                                <div class="col">{{ $destination->vicinity }}</div>
                            </li>
                        </ul>
                    </div>

                    <div class="row mb-3">
                        <div
                            class="col card-body d-flex justify-content-between align-items-center border shadow-sm p-4"
                            style="border-radius:20px">
                            <div class="price">
                                <h5>
                                    KSH.{{ number_format($destination->price) }}
                                    / {{ $destination->price_frequency }}
                                </h5>
                                @isset($destination->discount)
                                    <del class="text-muted small">KSH.25,000</del>
                                @endisset
                            </div>
                            <a href="{{ route('destinations.show.booking', ['id' => $destination->id]) }}"
                               class="btn btn-primary me-md-5 px-5">
                                <i class="fas fa-plus"></i> Reserve
                            </a>
                        </div>
                    </div>

                    <h6 class="col fw-bold mb-5"><i class="far fa-heart"></i> Add to my wish list</h6>

                    <div class="row">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link bg-transparent active" id="nav-description-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#nav-description" role="tab">Description
                                </button>
                                <button class="nav-link bg-transparent" id="nav-reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-reviews" role="tab">Reviews
                                </button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                 aria-labelledby="nav-description-tab">
                                <p class="small">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur esse illo nam
                                    vitae
                                    voluptate? Consequatur culpa exercitationem, explicabo fugit iusto laborum
                                    laudantium
                                    molestiae quam rerum similique sunt ullam unde vero!
                                </p>
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel"
                                 aria-labelledby="nav-reviews-tab">
                                <div class="list-group list-group-flush my-3">

                                    @foreach($reviews as $review)
                                        <div class="list-group-item bg-transparent">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <img src="{{ $review->profile_photo }}" alt=""
                                                         class="img-fluid rounded-circle shadow-sm p-1" width="40px"
                                                         height="40px">
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <p class="mb-1">{{ $review->name }}</p>
                                                        <small>
                                                            {{ now()->subDays(rand(1, $review->id))->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                    <small class="">
                                                        {!! $review->comment !!}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @include('partials.suggest_destinations')
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/swiper/swiper.min.js') }}"></script>
        <script>
            const thumbSwiper = new Swiper(".thumbSwiper", {
                loop: true,
                spaceBetween: 10,
                slidesPerView: 3,
                freeMode: true,
                watchSlidesProgress: true,
            });
            const swiper = new Swiper('.mainSwiper', {
                // Optional parameters
                loop: true,
                grabCursor: true,
                effect: "cube",
                cubeEffect: {
                    shadow: true,
                    slideShadows: true,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: true,
                },

                // Pagination
                pagination: {
                    el: '.swiper-pagination',
                    dynamicBullets: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                thumbs: {
                    swiper: thumbSwiper,
                },
            });

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

