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
        dataType: 'json',
        success: function (response) {
            $('#products').html(response.view);
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
