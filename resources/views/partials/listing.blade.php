<div class="row py-3 listing-item">
    @foreach($destinations as $destination)
        <div class="col-12 col-lg-6 body">
            <div class="card bg-transparent shadow">
                <div class="row g-0">
                    <div class="col-md-4 col-lg-12 image">
                        <img src="{{ asset("images/destinations/{$destination->image}") }}"
                             class="card-img p-2"
                             alt="...">
                        <div class="card-img-overlay">
                            <span class="badge rounded-pill bg-light text-primary">- 36 %</span>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 text">
                        <div class="card-body pt-2 position-relative">
                            <div class="row h-100">
                                <div class="col-7 col-lg-6 d-flex justify-content-between flex-column text-child">
                                    <h5 class="card-title fs-13 fw-bold">{{ $destination->name }}</h5>
                                    <p class="card-text text-secondary d-none small description">
                                        Space for a small
                                        product description
                                    </p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item small">Availability</li>
                                        <li class="list-group-item small">{{ $destination->vicinity }}</li>
                                    </ul>
                                </div>
                                <div class="col-5 col-lg-6 text-child d-flex flex-column justify-content-between">
                                    <div class="small fw-bold">
                                        <p class="mb-0">
                                            KSH.{{ number_format($destination->price) }}
                                            / {{ $destination->price_frequency }}
                                        </p>
                                        @isset($destination->discount)
                                            <del class="text-muted small">25,000</del>
                                        @endisset
                                    </div>
                                    <div>
                                        <a href="{{ route('destinations.show', ['id' => $destination->id]) }}"
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
    @endforeach
</div>
