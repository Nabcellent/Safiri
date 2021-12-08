<div class="container listing my-3">
    <div class="d-flex justify-content-between">
        <h6 class="m-0 fw-bold">Other destinations you may like:</h6>
        <a class="link-primary" href="{{ route('destinations.index') }}">
            More destinations <i class="fas fa-arrow-right"></i>
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
                            <div class="card bg-transparent shadow">
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

<script src="{{ asset('vendor/swiper/swiper.min.js') }}"></script>
<script>
    const swiperIntl = new Swiper('.swiper.intl', {
        // Optional parameters
        slidesPerView: 2,
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
