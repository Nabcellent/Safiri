@push('links')
    <link rel="stylesheet" href="{{ asset('vendor/ionrangeslider/ion.rangeSlider.min.css') }}">
@endpush

<div class="filter col-md">
    <div class="sticky-sidebar">
        <div class="sticky-top pt-4">
            <div><h6 class="fw-bold mb-4 text-uppercase">Categories</h6></div>
            <ul class="list-group list-group-flush">
                @foreach($categories as $category)
                    <label class="list-group-item">
                        <input class="form-check-input me-1 filter-check fil-category" type="checkbox"
                               value="{{ $category->id }}">
                        {{ ucwords(str_replace('_',' ', $category->title)) }}
                    </label>
                @endforeach
            </ul>

            <h6 class="fw-bold mb-4 mt-5 text-uppercase">Price</h6>
            <div class="row">
                <div class="col-12 form-group mb-2">
                    <input type="text" class="js-range-slider" name="my_range" id="price-range" aria-label/>
                </div>
                <div class="col-6 form-group">
                    <input type="number" min="0" value="{{ $minPrice }}"
                           class="form-control form-control-sm bg-transparent text-center rounded-0 price-range"
                           style="border:none; border-bottom: 1px solid var(--safiri-green)" aria-label id="min_price">
                </div>
                <div class="col-6 form-group">
                    <input type="number" min="0" value="{{ $maxPrice }}"
                           class="form-control form-control-sm bg-transparent text-center rounded-0 price-range"
                           style="border:none; border-bottom: 1px solid var(--safiri-green)" aria-label id="max_price">
                </div>
            </div>

            <h6 class="fw-bold mb-4 mt-5 text-uppercase">Vicinities</h6>
            <ul class="list-group list-group-flush">
                @foreach($vicinities as $vicinity)
                    <label class="list-group-item">
                        <input class="form-check-input me-1 filter-check fil-vicinity" type="checkbox"
                               value="{{ $vicinity->id }}">
                        {{ $vicinity->vicinity }}
                    </label>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('vendor/ionrangeslider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('js/filter.js') }}"></script>
    <script>
        /**
         * --------------------------------------------------------------------------------------   RANGE SELECTOR
         * */

        let minPrice = $('#min_price'), maxPrice = $('#max_price'), priceRangeEl = $('.price-range');

        let priceRangeSlider = $(".js-range-slider").ionRangeSlider({
            type: "double",
            skin: "sharp",
            min: 0,
            max: `{{ $maxPrice }}`,
            from: `{{ $minPrice }}`,
            to: `{{ $maxPrice }}`,
            drag_interval: true,
            min_interval: 2,
            keyboard: true,
            grid: true,
            onChange: function (data) {
                minPrice.val(data.from);
                maxPrice.val(data.to)
            },
            onFinish: () => getProducts()
        }).data("ionRangeSlider");

        priceRangeEl.on('keyup', () => {
            if (minPrice.val() > 0 && maxPrice.val() < 50000)
                priceRangeSlider.update({
                    from: minPrice.val(),
                    to: maxPrice.val()
                });
        });

        priceRangeEl.on('change', () => {
            if (minPrice.val() > 10 && maxPrice.val() < 10000) getProducts()
        });

        if (minPrice.val() && maxPrice.val()) priceRangeSlider.update({from: minPrice.val(), to: maxPrice.val()});
    </script>
@endpush
