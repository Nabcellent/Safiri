function oopsError(title = 'Oops...', message = 'Something went wrong') {
    return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
    })
}

window.sweet = data => {
    Swal.fire({
        title: data.title ? data.title : 'Oops...',
        text: data.msg,
        icon: data.type
    });
}

window.toast = data => {
    Toastify({
        text: data.msg,
        duration: data.duration ?? 7000,
        close: true,
        className: data.type,
    }).showToast();
}

window._number_format = number => {
    return new Intl.NumberFormat().format(number)
}
