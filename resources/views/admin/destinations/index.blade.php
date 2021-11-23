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
                    <h3>Product</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">ECommerce</li>
                        <li class="breadcrumb-item active">Product</li>
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
												<a href="cart.html"><i class="icon-shopping-cart"></i></a>
											</li>
											<li>
												<a data-bs-toggle="modal" data-bs-target="#exampleModalCenter16"><i class="icon-eye"></i></a>
											</li>
											<li>
												<a data-id="${place.place_id}" class="save-destination" title="Save"><i class="icon-save"></i></a>
											</li>
										</ul>
									</div>
								</div>
                                <div class="position-absolute saving-overlay py-2 px-3 ld-ext-right">
                                    Saving...<span class="ld ld-ring ld-spin"></span>
                                </div>
								<div class="modal fade" id="exampleModalCenter16">
									<div class="modal-dialog modal-lg modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<div class="product-box row">
													<div class="product-img col-lg-6">
                                                        <img class="img-fluid" src="/images/admin/ecommerce/01.jpg" alt=""/>
                                                    </div>
													<div class="product-details col-lg-6 text-start">
														<a href="product-page.html"><h4>${place.name}</h4></a>
														<div class="product-price">
															$26.00 <del>$35.00</del>
														</div>
														<div class="product-view">
															<h6 class="f-w-600">Destination Details</h6>
															<p class="mb-0">Sed ut perspiciatis, unde omnis iste natus error sit voluptatem
																accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo.</p>
														</div>
														<div class="product-qnty">
															<h6 class="f-w-600">Quantity</h6>
															<fieldset>
																<div class="input-group">
																	<input class="touchspin text-center" type="text" value="5"/>
																</div>
															</fieldset>
															<div class="addcart-btn">
                                                                <a class="btn btn-primary me-3" href="cart.html">Save</a>
                                                            </div>
														</div>
													</div>
												</div>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="product-details">
									<a href="product-page.html"><h4>${place.name}</h4></a>
									<div class="d-flex justify-content-between"><p>${openingHours}</p> ${rating} </div>
									<div class="product-price">
										$26.00<del>$35.00</del>
									</div>
								</div>
							</div>
						</div>
					</div>`
                })

                $('.product-wrapper-grid > .row').html(HTML_DESTINATIONS)
            }

            const fetchDestinations = data => {
                $.ajax({
                    data,
                    method: 'GET',
                    url: 'http://localhost:8000/api/destination/v1/all',
                    success: response => {
                        console.log(response)
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
            <script src="{{ asset('vendor/viho/js/select2/select2.full.min.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/select2/select2-custom.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/tooltip-init.js') }}"></script>
            <script src="{{ asset('vendor/viho/js/product-tab.js') }}"></script>
            <!-- Plugins JS Ends-->

            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#save-destinations').on('click', function () {
                    storeDestinations({destinations: window.DESTINATIONS}, $(this))
                });

                $(document).on('click', '.save-destination', function () {
                    const savingOverlay = $(this).closest('.product-box').find($('.saving-overlay'));

                    $(this).closest('ul').addClass('d-none');
                    savingOverlay.show(300);
                    $(this).closest('.product-box').addClass('saving');

                    storeDestinations({place_id: $(this).data('id')}, savingOverlay)
                });

                const storeDestinations = (data, element) => {
                    $.ajax({
                        data: data,
                        url: `{{ route('admin.destinations.store') }}`,
                        method: 'POST',
                        beforeSend: () => {
                            element.html(`Saving... <span class="ld ld-ring ld-spin"></span>`).addClass('running disabled')
                        },
                        success: response => toast({
                            msg: response.message,
                            type: (response.status ? 'success' : 'warning')
                        }),
                        error: error => {
                            console.log(error)

                            sweet({
                                title: 'Error',
                                msg: 'Something went wrong while saving destinations.',
                                type: 'error'
                            })
                        },
                        complete: xhr => {
                            let err = eval("(" + xhr.responseText + ")");

                            if (err.status !== true) element.prop('disabled', false).removeClass('running')

                            if (data.place_id) {
                                element.hide(300);
                                element.closest('.product-box').removeClass('saving');
                                element.closest('.product-box').find($('ul')).removeClass('d-none');
                            }
                        }
                    });
                }
            </script>
        @endpush
    @endonce
@endsection
