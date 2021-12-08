$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).on('click', '.delete-resource', function() {
    const id = $(this).data('id');
    const model = $(this).data('model');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                data: {id, model},
                method: 'DELETE',
                url: `/admin/delete`,
                // beforeSend: () => { showLoader(`Deleting ${model}...`) },
                statusCode: { 200: (response) => { return response; } },
                error: () => { return 'error'; }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            if(result.value === 'success') {
                $(this).closest('tr').remove()
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Deleted!',
                    text: `Your ${model} has been deleted.`,
                    timer: 3000,
                    showConfirmButton: false
                })
            } else {
                oopsError();
            }
        }
    })
});
