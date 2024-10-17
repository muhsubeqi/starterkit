let Toast = Swal.mixin({
    toast: true,
    animation: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 3000,
    customClass: {
        popup: 'p-2 opacity-80',
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
  })

export default function sweetAlert(status, message) {
    if (status == 200) {
        Toast.fire({
            icon: 'success',
            text: message,
            showConfirmButton: false,
        })
    } else {
        Toast.fire({
            icon: 'error',
            text: message,
            showConfirmButton: false,
        })
    }
}

