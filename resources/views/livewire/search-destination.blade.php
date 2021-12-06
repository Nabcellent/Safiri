<div>
    <form id="search-ads-form" method="get" class="row justify-content-center mt-2">
        <div class="col-md-6 p-1 bg-light rounded rounded-pill shadow-sm">
            <div class="input-group px-3">
                <input type="search" placeholder="Search for ads..." wire:model.debounce.200ms="term"
                       class="form-control form-control-sm border-0 me-2 bg-transparent" aria-label="">
                <div class="input-group-append d-flex align-items-center"><i class="fa fa-search text-primary"></i></div>
            </div>
        </div>
    </form>

    <div wire:loading.flex class="row justify-content-center align-items-center" style="height: 70vh">
        <div class="col-7">
            <img src="{{ asset('images/svg-loaders/three-dots-safiri.svg') }}" alt="Loader" class="img-fluid w-100">
        </div>
    </div>

    <div wire:loading.remove>
        <!--    notice that $term is available as a public variable, even though it's not part of the data array    -->
        @if (empty($term))
            <p class=" fs-12 text-muted text-center mb-0">Search for title or description</p>
            @include('partials.listing')
        @else
            @if($destinations->isEmpty())
                <div class="row justify-content-center align-items-center" style="height: 70vh">
                    <div class="col-7">
                        <div class="divider divider-left mb-0">
                            <div class="divider-text bg-blue-dark card-header">
                                <h3 class="text-blue-light">No destination matches your search.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('partials.listing')
            @endif
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-auto">{{ $destinations->links() }}</div>
    </div>

</div>
