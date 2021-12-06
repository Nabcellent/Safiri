$('#booking-form').validate({
    rules: {
        dates: 'required'
    },
    messages: {
        dates: {
            required: 'Please select the range of dates'
        }
    }
})
