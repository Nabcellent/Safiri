@extends('layouts.master')
@section('title', 'Destinations')
@section('content')

    <div id="destinations">
        <nav class="container-fluid my-2" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Domestic deals</li>
            </ol>
        </nav>

        <div class="row justify-content-center pb-4 banner-bg">
            <div class="card bg-dark border-0 text-white">
                <img src="{{ asset('images/admin/big-masonry/7.jpg') }}" class="card-img" alt="...">
                <div class="card-img-overlay justify-content-center d-flex align-items-center">
                    <div class="text-center">
                        <h5 class="card-title">Domestic deals</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta doloremque et
                            facere facilis harum ipsam itaque laudantium nesciunt nostrum, odit quaerat reprehenderit
                            sequi
                            veritatis voluptas voluptatum! Illum quaerat quasi vitae.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container listing my-3">
            <div class="row position-relative">
                @include('partials.filters')

                <div class="col-sm-9">
                    @for($i = 0; $i < 5; $i++)
                        <div class="row py-3 listing-item">
                            <div class="col">
                                <div class="card bg-transparent shadow">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ asset('images/admin/big-masonry/14.jpg') }}"
                                                 class="card-img p-2"
                                                 alt="...">
                                            <div class="card-img-overlay">
                                                <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body position-relative">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h5 class="card-title fs-13 fw-bold">Mombasa holiday trip</h5>
                                                        <p class="card-text text-secondary small">Space for a small
                                                            product description</p>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">Availability</li>
                                                            <li class="list-group-item">Capacity</li>
                                                            <li class="list-group-item">Vicinity</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 d-flex flex-column justify-content-between">
                                                        <div class="small fw-bold">
                                                            <p class="mb-0">KSH.20,000</p>
                                                            @if($i === 2)
                                                                <del class="text-muted small">25,000</del>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('destinations.show', ['id' => $i]) }}"
                                                               class="btn btn-sm col-12 my-1 btn-primary fs-13 fw-bold rounded-3">
                                                                More details <i class="bi bi-chevron-right"></i>
                                                            </a>
                                                            <a href="#"
                                                               class="btn btn-sm col-12 my-1 btn-outline-primary fs-13 fw-bold rounded-3">
                                                                <i class="far fa-heart"></i> Add to wishlist
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <hr>
    </div>

@endsection
