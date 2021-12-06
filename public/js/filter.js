/**==============================================================================  Pagination   */
$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();

    let page = $(this).attr('href').split('page=')[1];
    let ajaxUrl = '/get-filtered-products?page=' + page;

    getProducts(ajaxUrl);
});

/**==============================================================================  Filter Categories   */
$(document).on('click', '.filter-check', function () {
    getProducts();
});

const getProducts = (url = '/destinations/filter') => {
    $('#loader').show();

    let category = getFilterText('category'),
        vicinity = getFilterText('vicinity'),
        priceRange = [parseInt($('#min_price').val()), parseInt($('#max_price').val())];

    $.ajax({
        data: {
            category,
            vicinity,
            priceRange,
        },
        type: 'GET',
        url: url,
        success: response => {
            if (response.count) {
                $('#filtered-destinations').html(response.view);
            } else {
                $('#filtered-destinations').html(`<div class="row justify-content-center align-items-center"
                                                      style="height: 70vh">
                    <div class="col-7">
                        <div class="divider divider-left mb-0">
                            <div class="divider-text bg-blue-dark card-header">
                                <h3 class="text-blue-light">No destination matches your filter.</h3>
                            </div>
                        </div>
                    </div>
                </div>`);
            }

            $('#shop-count').text(response.count);
            $('#loader').hide();

            // AOS.refreshHard()
        }
    })
}

function getFilterText(text_id) {
    let filterData = [];

    $('.fil-' + text_id + ':checked').each(function () {
        filterData.push($(this).val());
    });
    return filterData;
}
