@extends('admin.layouts.app')
@section('title', 'Destinations')
@once
    @push('links')
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/select2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/range-slider.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/loadingBtn/ldbtn.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/loadingBtn/loading.min.css') }}">
        <!-- Plugins css Ends-->
    @endpush
@endonce
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row justify-content-between">
                <div class="col-lg-6">

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Destinations</li>
                    </ol>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-primary ld-ext-right" id="first-page" title="First page"
                            style="display:none;">
                        <i class="fas fa-angle-double-left"></i>
                        <span class="ld ld-ring ld-spin"></span>
                    </button>
                    <button class="btn btn-sm btn-outline-primary ld-ext-right me-2" id="next-page" title="Next page"
                            style="display:none;">
                        <i class="fas fa-angle-right"></i>
                        <span class="ld ld-ring ld-spin"></span>
                    </button>
                    <button
                        class="btn btn-sm btn-outline-primary ld-ext-right @if($savingDestinations) running disabled @endif"
                        id="save-destinations" title="Save destinations">
                        @if($savingDestinations) Saving... @else <i class="fas fa-cloud-download"></i> @endif
                        <span class="ld ld-ring ld-spin"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid product-wrapper">
        <div class="product-grid">

            @include('admin.destinations.filters')

            <div class="product-wrapper-grid">
                <div class="row">

                    {{--    LOAD DESTINATIONS FROM API HERE    --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        $(() => {
            window.DESTINATIONS = [];

            const nextPageBtn = $('#next-page'),
                firstPageBtn = $('#first-page')

            const showDestinations = destinations => {
                const HTML_DESTINATIONS = destinations.map(place => {
                    if (!place.photo) return;

                    window.DESTINATIONS.push(place)

                    const rating = place.rating ? `<small>Rating - ${place.rating}</small>` : '';

                    let openingHours = place.opening_hours
                        ? place.opening_hours['open_now'] ? 'Open' : 'Closed'
                        : 'N/A';

                    return `<div class="col-xl-3 col-sm-6 xl-4">
						<div class="card">
							<div class="product-box">
								<div class="product-img">
									<img class="img-fluid w-100" src="${place.photo}" alt="Destination Image" style="height:20rem; object-fit:cover;"/>
									<div class="product-hover">
										<ul>
											<li>
												<a data-id="${place.place_id}" class="save-destination" title="Save"><i class="icon-save"></i></a>
											</li>
										</ul>
									</div>
								</div>
                                <div class="position-absolute saving-overlay py-2 px-3 ld-ext-right">
                                    Saving...<span class="ld ld-ring ld-spin"></span>
                                </div>
								<div class="product-details">
									<h4>${place.name}</h4>
									<div class="d-flex justify-content-between"><p>${openingHours}</p> ${rating} </div>
								</div>
							</div>
						</div>
					</div>`
                })

                $('.product-wrapper-grid > .row').html(HTML_DESTINATIONS)
            }

            window.fetchDestinations = data => {
                $.ajax({
                    data,
                    method: 'GET',
                    url: '/api/destination/v1/all',
                    success: response => {
                        if (response.next_page_token) {
                            nextPageBtn.attr('data-id', response.next_page_token).show(300)
                        } else {
                            nextPageBtn.hide(300)
                        }

                        showDestinations(response.destinations)

                        nextPageBtn.removeClass('running disabled')
                        firstPageBtn.removeClass('running disabled')
                    },
                    error: error => {
                        console.log(error)
                    },
                })
            }

            fetchDestinations()

            nextPageBtn.on('click', function () {
                nextPageBtn.addClass('running disabled')

                fetchDestinations({pagetoken: nextPageBtn.data('id')})

                firstPageBtn.show(300)
            })

            firstPageBtn.on('click', function () {
                nextPageBtn.attr('data-id', [])
                nextPageBtn.removeAttr('data-id')
                firstPageBtn.addClass('running disabled')

                fetchDestinations()
            })
        })
    </script>

    @once
        @push('scripts')
            <!-- Plugins JS start-->
            <script src="{{ asset('vendor/viho/js/range-slider/ion.rangeSlider.min.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/range-slider/rangeslider-script.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/touchspin/vendors.min.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/touchspin/touchspin.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/touchspin/input-groups.min.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/owlcarousel/owl.carousel.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/tooltip-init.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/product-tab.js') }}"></script>
            <!-- Plugins JS Ends-->
            <script src="{{ asset('js/admin/destination.js') }}"></script>
        @endpush
    @endonce
@endsection
