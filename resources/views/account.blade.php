@extends('layouts.master')
@section('title', 'Account')
@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper.min.css') }}"/>
@endpush
@section('content')

    <div id="thanks">
        <div class="container listing my-3">
            <div class="card my-md-4 py-md-4 bg-transparent">
                <div class="bg-holder d-none d-lg-block bg-card bg-left"
                     style="background-image:url({{ asset("images/destinations/{$latestActiveBooking?->destination->image}") }}); width: 20rem;"></div>
                <div class="bg-holder d-none d-lg-block bg-card"
                     style="background-image:url({{ asset('images/spot-illustrations/corner-2.png') }});"></div>
                <div class="card-body position-relative">
                    <div class="row fw-bold">
                        <div class="col-md-7 text-center">
                            <h6 class="fw-bold">Latest active destination</h6>
                            <p class="small">{{ $latestActiveBooking?->destination->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col text-center">
                            <p class="m-0">Total Bookings - {{ $user->bookings_count }}</p>
                            <p class="m-0">Total Reviews - {{ $user->reviews_count }}</p>
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
                                <td class="px-0 pt-4">
                                    <a href="{{ route('destinations.show', ['id' => $booking->destination_id]) }}"
                                       class="link-primary">{{ $booking->destination->name }}</a>
                                </td>
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

            @include('partials.suggest_destinations')

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
