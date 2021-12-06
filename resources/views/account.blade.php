@extends('layouts.master')
@section('title', 'Profile')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
@endpush
@section('content')

    <div id="thanks">
        <div class="container listing my-3">
            <div class="card my-md-4 py-md-4 bg-transparent">
                <div class="bg-holder d-none d-lg-block bg-card"
                     style="background-image:url({{ asset('images/spot-illustrations/corner-2.png') }});"></div>
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

            <div class="row my-5">
                <div class="col table-responsive overflow-auto" style="max-height: 100vh">
                    <table class="table table-borderless">
                        <thead>
                        <tr style="border-bottom:1px solid #D9D9D9">
                            <th class="bg-transparent text-dark px-0">Destination</th>
                            <th class="bg-transparent text-dark px-0">Pay Method</th>
                            <th class="bg-transparent text-dark px-0">Status</th>
                            <th colspan="2" class="bg-transparent text-dark px-0">Total</th>
                        </tr>
                        </thead>
                        <tbody id="accordion">

                        @forelse($bookings as $booking)
                            <tr style="border-bottom:1px solid #D9D9D9;">
                                <td class="px-0 pt-4"><p class="text-muted">{{ $booking->destination->name }}</p></td>
                                <td class="px-0 pt-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="text-muted">{{ ucfirst($booking->paymentMethod->name) }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-0 pt-4">
                                    <h6 class="fw-bold mb-0">{{ $booking->is_paid ? 'Paid' : 'Pending payment' }}</h6>
                                </td>
                                <td class="px-0 pt-4">
                                    <h6 class="fw-bold mb-0">KSH.{{ number_format($booking->total, 2) }}</h6>
                                </td>
                                <td class="px-0">
                                    <a href="javascript:void(0)" class="text-secondary me-2"
                                       title="View details"
                                       data-bs-toggle="collapse" data-bs-target="#product-{{ $booking->id }}">
                                        <i class="fas fa-hotel"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr class="accordion-item bg-transparent border-0">
                                <td colspan="6" class="p-0">
                                    <div class="ml-3 collapse" data-bs-parent="#accordion"
                                         id="product-{{ $booking->id }}">
                                        <table class="table table-sm small">
                                            <thead>
                                            <tr>
                                                <th>Guests</th>
                                                <th>Period</th>
                                                <th>{{ ucfirst(Str::plural($booking->destination->price_frequency)) }}</th>
                                                <th>Price per {{ $booking->destination->price_frequency }}</th>
                                                <th>Service charge</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{ $booking->guests }}</td>
                                                <td>{{ $booking->start_at->format('M jS Y') . ' to ' . $booking->end_at->format('M jS Y') }}</td>
                                                <td>{{ $booking->end_at->diffInDays(now()) }}</td>
                                                <td>{{ number_format($booking->destination->price, 2) }}</td>
                                                <td>{{ number_format($booking->service_fee, 2) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">
                                    <h5 class="my-3">You haven't made any reservation yet</h5>
                                    <button class="btn btn-primary">Make one now 😁</button>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

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
                            <div class="swiper-wrapper btn-secondary">
                                <!-- Slides -->
                                @foreach($suggestedDestinations as $destination)
                                    <div class="swiper-slide">
                                        <div class="card bg-transparent shadow" style="width: 17rem;">
                                            <img src="{{ asset("images/destinations/{$destination->image}") }}"
                                                 class="card-img p-2" alt="...">
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
                                                        @if($destination->id === 2)
                                                            <del class="small">25,000</del>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('destinations.show.booking', ['id' => $destination->id]) }}"
                                                       class="btn btn-sm btn-primary fs-13 fw-bold rounded-3">Book
                                                        Now</a>
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

            <div class="card my-5 py-5" style="background-color: #ba895d">
                <div class="bg-holder d-none d-lg-block bg-card"
                     style="background-image:url({{ asset('images/spot-illustrations/corner-4.png') }});"></div>
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col text-light text-center">
                            <button id="delete-account" class="btn btn-sm btn-outline-light">Delete account <i
                                    class="fas fa-trash"></i></button>
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

            $('#delete-account').on('click', () => {
                Swal.fire({
                    title: 'Are you sure? 😢',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.isConfirmed) location.href = `{{ route('user.destroy', ['id' => $user->id]) }}`
                })
            })
        </script>
    @endpush
@endsection
