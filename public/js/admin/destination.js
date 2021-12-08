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
        url: `/admin/destinations/store-api`,
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

$('#search-vicinity').on('submit', (e) => {
    e.preventDefault()

    const submitButton = $('#search-vicinity').find($('button'));

    $.ajax({
        data: {text: $('#search-vicinity input').val()},
        url: `/admin/destinations/find-place`,
        beforeSend: () => {
            submitButton.html(`Searching... <span class="ld ld-ring ld-spin"></span>`).addClass('running disabled')
        },
        success: response => {
            if (response.status) {
                let {location} = response.data.geometry
                const locationString = `${location.lat},${location.lng}`

                fetchDestinations({location: locationString})
            } else {
                toast({msg: response.message, type: 'info'})
            }
        },
        error: error =>  console.log(error),
        complete: () => {
            submitButton.html(`<i class="fa fa-search me-2"></i> Search`).removeClass('running disabled')
        }
    })
})
