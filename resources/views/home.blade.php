@extends('layouts.master')
@section('content')

    <div id="home">
        <div class="row justify-content-center py-4 banner-bg">
            <div class="col-md-4">
                <div class="card py-5 px-4">
                    <div class="mb-md-5">
                        <h5>Banner</h5>
                        <h4>Heading</h4>
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            More Info <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card py-5 px-4">
                    <div class="mb-md-5">
                        <h5>Banner</h5>
                        <h4>Heading</h4>
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            More Info <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container listing my-3">
            @for($i = 0; $i < 2; $i++)
                <div class="row py-3">
                    <div class="col-3">
                        <h6 class="fw-bold text-center">Best deals</h6>
                        <a href="#" class="btn btn-sm btn-outline-secondary mt-4">
                            See more <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>

                    @for($j = 0; $j < 3; $j++)
                        <div class="col-md-3">
                            <div class="card bg-transparent shadow" style="width: 18rem;">
                                <img src="{{ asset('images/admin/big-masonry/14.jpg') }}" class="card-img p-2"
                                     alt="...">
                                <div class="card-img-overlay">
                                    <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                                </div>
                                <div class="card-body position-relative">
                                    <h5 class="card-title fs-13 fw-bold">Mombasa holiday trip</h5>
                                    <p class="card-text text-secondary small">Space for a small product description</p>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="small fw-bold" style="height: 2rem">
                                            <p class="mb-0">KSH.20,000</p>
                                            @if($j === 2)
                                                <del>25,000</del>
                                            @endif
                                        </div>
                                        <a href="{{ route('destinations.show.booking', ['id' => 1]) }}"
                                           class="btn btn-sm btn-primary fs-13 fw-bold rounded-3">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>
            @endfor
        </div>

        <hr>

        <div class="container-fluid testimonials my-5">
            <div class="row px-md-5 mx-md-5">
                <div class="col">
                    <h5 class="ms-md-5">Our travellers' say</h5>
                    <div class="row">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col px-3 position-relative">
                                <figure class="card bg-transparent p-4 text-center">
                                    <blockquote cite="https://www.huxley.net/bnw/four.html">
                                        <q>This is a super place for your customers quote. Don't worry it works smooth
                                            as pie. You will get all you need by writing a text here.</q>
                                    </blockquote>
                                    <figcaption class="text-muted">~ Name & surname, <cite>date</cite></figcaption>
                                </figure>
                                <div class="circle rounded-circle position-absolute"></div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="container listing my-3">
            <h5 class="mt-3">International</h5>
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

@endsection
