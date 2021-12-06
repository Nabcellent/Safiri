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

    if(!$(this).valid()) return;

    const data = {}
    $(this).serializeArray().map(input => data[input.name] = input.value)

    data.total = totalPrice;
    data.service_fee = SERVICE_FEE

    if (paymentMethod === 'mpesa') {
        payWithMpesa(data)
    } else {
        $('#booking-form').get(0).submit()
    }
})
