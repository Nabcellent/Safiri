/**--------------------------------------------------------------------------------------------
 *                                  PROCESS BOOKING SUBMISSION
 * */
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

const submitButton = $('#booking-form button[type="submit"]');

let paymentMethod = $('input[name="payment_method"]:checked').val();

$('input[name="payment_method"]').on('change', function () {
    paymentMethod = $(this).val()

    if (paymentMethod === 'paypal') {
        submitButton.hide(300);
        $('#paypal_payment_button').show(300)
    } else {
        submitButton.html(`Confirm Reservation <i class="fas fa-map-pin"></i>`)
        submitButton.show(300);
        $('#paypal_payment_button').hide(300)
    }
})

$('#booking-form').on('submit', function (e) {
    e.preventDefault()

    const data = {}
    $(this).serializeArray().map(input => data[input.name] = input.value)

    data.total = totalPrice;
    data.service_fee = SERVICE_FEE

    const submitBooking = () => {
        $.ajax({
            data,
            url: ``,
            method: `POST`,
            dataType: 'json',
            beforeSend: () => submitButton/*.prop('disabled', true)*/.html(`Reserving...
                                            <span class="ld ld-ring ld-spin"></span>`).addClass('running'),
            success: response => {
                console.log(response)
            },
            complete: (xhr) => {
                let err = eval("(" + xhr.responseText + ")");

                if (err.status !== true) submitButton.prop('disabled', false).html(`Confirm reservation
										<span class="ld ld-ring ld-spin"></span>`).removeClass('running')
            }
        })
    }

    if (paymentMethod === 'mpesa') {
        payWithMpesa(data)
    } else if (paymentMethod === 'paypal') {
        submitBooking()
    } else {
        submitBooking()
    }
})
