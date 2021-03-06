const PAYPAL_CALLBACK_URL = '/payments/paypal-callback',
    PHONE_REGEX = /^((0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6}))$/

function payWithMpesa(formData) {
    const phone = $("#phone").val().replace(/\s/g,'')

    Swal.fire({
        input: 'tel',
        inputLabel: 'Phone number',
        inputPlaceholder: 'Enter the phone number',
        inputValue: phone.match(PHONE_REGEX) ? phone : '',
        showLoaderOnConfirm: true,
        preConfirm: phoneNumber => {
            if (!phoneNumber.match(PHONE_REGEX)) {
                Swal.showValidationMessage('Invalid phone number.')
            } else {
                formData.phone = phoneNumber;
                formData.amount = 1;

                return $.ajax({
                    data: formData,
                    method: 'POST',
                    url: `/payments/stk-request`,
                    dataType: 'json',
                    statusCode: {
                        200: response => {
                            return response.content;
                        },
                    },
                    error: () => {
                        console.log("error");
                        return {
                            message: 'Something went wrong!'
                        };
                    }
                })
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(result => {
        if (result.isConfirmed && result.value.requestId) {
            new STK(result.value.requestId).checkStkStatus()
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Sorry...',
                text: result.value.message,
            });
        }
    })
}

class STK {
    constructor(checkout_request_id) {
        this.CHECKOUT_REQUEST_ID = checkout_request_id;
    }

    checkStkStatus(data = {}) {
        let sweetText = data.sweetText ?? "Your request has been received and is being processed. PLEASE ENTER MPESA PIN when prompted, then click OK.";

        Swal.fire({
            icon: "info",
            title: "Info",
            text: sweetText,
            showLoaderOnConfirm: true,
            showCancelButton: true,
            preConfirm: () => {
                return $.ajax({
                    url: '/payments/stk-status/' + this.CHECKOUT_REQUEST_ID,
                    type: 'GET',
                    dataType: 'json',
                    success: response => {
                        return response;
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isDismissed && result.dismiss === 'cancel') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Payment Cancelled',
                    text: 'Safiri',
                    timer: 3000,
                    showConfirmButton: false
                })//.then(() => hideLoader())
            } else if (result.isConfirmed) {
                this.stkStatusResponse(result.value)
            } else {
                this.fetchStkStatus().then(result => this.stkStatusResponse(result));
            }
        })
    }

    async fetchStkStatus() {
        return await fetch('/payments/stk-status/' + this.CHECKOUT_REQUEST_ID)
            .then(response => response.json())
            .then(data => {
                return data;
            });
    }

    stkStatusResponse(data) {
        if (data.status === 'processing') {
            this.checkStkStatus({sweetText: 'Payment still in process. Kindly retry after getting the Mpesa message or in 3 seconds if cancelled.'})
        } else if (data.status === 'processed') {
            Swal.fire({
                position: 'top-end',
                icon: data.icon,
                title: data.message,
                text: 'Safiri',
                timer: 3000,
                showConfirmButton: false
            }).then(() => {
                if (data.url !== "") {
                    window.location = data.url
                }
            });
        } else if (data.status === 'failed') {
            Swal.fire({
                icon: 'error',
                title: 'Sorry...',
                text: data.message,
                // willClose: hideLoader,
                footer: '<a href>Report this issue?</a>'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                // willClose: hideLoader,
                footer: '<a href>Report this issue?</a>'
            });
        }
    }
}


/**---------------------------------------------------------------------------------------------------
 *                          PAYPAL PAYMENT
 * ---------------------------------------------------------------------------------------------------*/
if ($('#paypal_payment_button').length) {
    const formData = {}
    $('#booking-form').serializeArray().map(input => formData[input.name] = input.value)

    paypal.Buttons({
        style: {
            color: 'blue',
            layout: 'vertical',
            shape: 'rect',
            label: 'pay',
            height: 35,
        },
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: "USD",
                        value: 1
                        //value: parseFloat(AMOUNT_USD)
                    },
                    payee: {
                        email_address: 'sb-kg0wb2320059@business.example.com'
                    }
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then((details) => {
                formData.payload = details
                formData.status = 'Paid'

                $.ajax({
                    data: formData,
                    type: 'POST',
                    url: PAYPAL_CALLBACK_URL,
                    dataType: 'json',
                    beforeSend: () => toast({msg: 'Processing payment. Please wait...', duration: 30000}),
                    statusCode: {
                        200: (response) => {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Payment Successful!',
                                    text: 'Safiri',
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(() => {
                                    $('#is_paid').val(response.id)
                                    $('#booking-form').get(0).submit()
                                });
                            } else {
                                toast(response.message)
                            }
                        },
                    },
                    error: () => toast({msg: "Oops! something went wrong!"})
                });
            });
        },
        onCancel: (data) => {
            data.status = 'Cancelled';
            formData.payload = data;

            $.ajax({
                data: formData,
                type: 'POST',
                url: PAYPAL_CALLBACK_URL,
                dataType: 'json',
            })

            Swal.fire({
                title: 'Payment Cancelled.',
                position: 'top-end',
                icon: 'info',
                text: 'Safiri',
                timer: 3000,
                showConfirmButton: false
            })
        }
    }).render('#paypal_payment_button');
}
