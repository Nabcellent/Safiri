@extends('layouts.master')
@section('title', 'Details')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
    <style>
        .swiper {
            width: 45rem;
            height: 30rem;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbSwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .thumbSwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .thumbSwiper .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
@endpush
@section('content')

    <div id="details">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Domestic deals</a></li>
                <li class="breadcrumb-item active" aria-current="page">Maasai Mara trip package</li>
            </ol>
        </nav>

        <div class="container-fluid px-lg-10">
            <div class="row px-lg-10">
                <div class="col">
                    <div class="swiper mainSwiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img src="{{ asset('https://swiperjs.com/demos/images/nature-1.jpg') }}" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('https://swiperjs.com/demos/images/nature-2.jpg') }}" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('https://swiperjs.com/demos/images/nature-3.jpg') }}" alt="">
                            </div>
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
                                <img src="https://swiperjs.com/demos/images/nature-1.jpg" alt=""/>
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-2.jpg" alt=""/>
                            </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-3.jpg" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="row mb-5">
                        <div class="col">
                            <h3>Maasai Mara Trip Package</h3>
                            <p>--- rating ---</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <ul class="col-md-6 list-group-flush">
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Lorem</div>
                                <div class="col">Lorem ipsum</div>
                            </li>
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Availability</div>
                                <div class="col">Available</div>
                            </li>
                            <li class="list-group-item bg-transparent d-flex row">
                                <div class="col">Location</div>
                                <div class="col">Nairobi, Kenya</div>
                            </li>
                        </ul>
                    </div>

                    <div class="row mb-3">
                        <div
                            class="col card-body d-flex justify-content-between align-items-center border shadow-sm p-4"
                            style="border-radius:20px">
                            <div class="price">
                                <h5>KSH.3,623</h5>
                                <del>KSH.4,856</del>
                            </div>
                            <a href="{{ route('destinations.show.booking', ['id' => 1]) }}"
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

        <div class="container listing py-3">
            <div class="d-flex justify-content-between">
                <h6 class="m-0 fw-bold">Other destinations you may like:</h6>
                <a class="link-primary" href="{{ route('destinations.index') }}">More destinations <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="row py-3">

                @for($i = 0; $i < 4; $i++)
                    <div class="col-3">
                        <div class="card bg-transparent shadow" style="width: 18rem;">
                            <img src="{{ asset('images/admin/big-masonry/14.jpg') }}" class="card-img p-2" alt="...">
                            <div class="card-img-overlay">
                                <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                            </div>
                            <div class="card-body position-relative">
                                <h5 class="card-title fs-13 fw-bold">Mombasa holiday trip</h5>
                                <p class="card-text text-secondary small">Space for a small product description</p>
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="small fw-bold" style="height: 2rem">
                                        <p class="mb-0">KSH.20,000</p>
                                        @if($i === 2)
                                            <del class="text-muted">25,000</del>
                                        @endif
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary fs-13 fw-bold rounded-3">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

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

        </script>
    @endpush
@endsection
