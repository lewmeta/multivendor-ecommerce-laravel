
// Datepicker init
$('.datepicker').datepicker();

// notif init
// notyf init
var notyf = new Notyf({
    duration: 3000
});


$(function () {
    $('.delete-item').on('click', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })

            }
        });
    });
})
