var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 3000
  });

export default function sweetAlert(status, message) {
    if (status == 200) {
        Toast.fire({
            icon: 'success',
            text: message,
            showConfirmButton: false,
            timer: 1000
        })
    } else {
        Toast.fire({
            icon: 'error',
            text: message,
            showConfirmButton: false,
            timer: 1000
        })
    }
}

