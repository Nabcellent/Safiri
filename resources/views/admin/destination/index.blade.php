@extends('admin.layouts.app')
@once
    @push('links')
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/select2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/viho/css/range-slider.css') }}">
        <!-- Plugins css Ends-->
    @endpush
@endonce
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Product</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard.html">Home</a></li>
                        <li class="breadcrumb-item">ECommerce</li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid product-wrapper">
        <div class="product-grid">

            @include('admin.destination.filters')

            <div class="product-wrapper-grid">
                <div class="row">

                    {{--    LOAD DESTINATIONS FROM API HERE    --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        $(() => {
            $.ajax({
                method: 'GET',
                url: 'http://localhost:8000/api/destination/v1/all',
                success: response => {
                    console.log(response)

                    const destinations = response.map(place => {
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
										</ul>
									</div>
								</div>
								<div class="modal fade" id="exampleModalCenter16">
									<div class="modal-dialog modal-lg modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<div class="product-box row">
													<div class="product-img col-lg-6"><img class="img-fluid" src="/images/admin/ecommerce/01.jpg"
													                                       alt=""/></div>
													<div class="product-details col-lg-6 text-start">
														<a href="product-page.html"><h4>Man's Jacket</h4></a>
														<div class="product-price">
															$26.00
															<del>$35.00</del>
														</div>
														<div class="product-view">
															<h6 class="f-w-600">Product Details</h6>
															<p class="mb-0">Sed ut perspiciatis, unde omnis iste natus error sit voluptatem
																accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo.</p>
														</div>
														<div class="product-size">
															<ul>
																<li>
																	<button class="btn btn-outline-light" type="button">M</button>
																</li>
																<li>
																	<button class="btn btn-outline-light" type="button">L</button>
																</li>
																<li>
																	<button class="btn btn-outline-light" type="button">Xl</button>
																</li>
															</ul>
														</div>
														<div class="product-qnty">
															<h6 class="f-w-600">Quantity</h6>
															<fieldset>
																<div class="input-group">
																	<input class="touchspin text-center" type="text" value="5"/>
																</div>
															</fieldset>
															<div class="addcart-btn"><a class="btn btn-primary me-3" href="cart.html">Add to Cart </a><a
																		class="btn btn-primary" href="product-page.html">View Details</a></div>
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
										$26.00
										<del>$35.00</del>
									</div>
								</div>
							</div>
						</div>
					</div>`
                    })

                    $('.product-wrapper-grid > .row').html(destinations)
                },
                error: error => {
                    console.log(error)
                }
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
        @endpush
    @endonce
@endsection
