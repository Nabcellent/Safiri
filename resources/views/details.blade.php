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
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Domestic deals</a></li>
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
                                <img src="{{ asset("images/destinations/{$destination->image}") }}" alt="">
                            </div>
                            @foreach($destination->destinationImages as $image)
                                <div class="swiper-slide">
                                    <img src="{{ asset("images/destinations/$image->image") }}" alt="">
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
                                <img src="{{ asset("images/destinations/{$destination->image}") }}" alt=""/>
                            </div>
                            @foreach($destination->destinationImages as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset("images/destinations/$image->image") }}" alt=""/>
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
                                <h5>KSH.{{ number_format($destination->price) }}</h5>
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
                                <h6 class="my-3">Category</h6>
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

                                    @for($i = 0; $i < 3; $i++)
                                        <div class="list-group-item bg-transparent">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <img src="{{ asset('images/admin/avtar/11.jpg') }}" alt=""
                                                         class="img-fluid rounded-circle shadow-sm p-1" width="40px"
                                                         height="40px">
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <p class="mb-1">Lindsey Stirling</p>
                                                        <small>3 days ago</small>
                                                    </div>
                                                    <small class="">This is <strong>THE</strong> place to be
                                                        !!!😍😍😍</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="container listing my-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 fw-bold">Other destinations you may like:</h6>
                <a class="link-primary" href="{{ route('destinations.index') }}">More destinations <i
                        class="fas fa-arrow-right"></i></a>
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
                                             class="card-img p-2"
                                             alt="...">
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

