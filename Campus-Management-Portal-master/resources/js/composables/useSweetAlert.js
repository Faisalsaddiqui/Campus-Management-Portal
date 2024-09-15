import { ref } from 'vue'
import Swal from 'sweetalert2'

const useSweetAlert = () => {
  const alert = ref(null)
  const alertSuccess = ({ title = 'Success!', text = "That's all done!", timer = 1000, showConfirmationButton = false } = {}) => {
    alert.value = Swal.fire({
      title: title,
      text: text,
      timer: timer,
      showConfirmButton: showConfirmationButton,
      type: 'success'
    })
  }

  const alertError = ({ title = 'Error!', text = 'Oops...Something went wrong' } = {}) => {
    alert.value = Swal.fire({
      title: title,
      text: text,
      type: 'error',
      icon: 'error',
      confirmButtonColor: '#ea7473'
    })
  }

  const alertConfirm = (callback, options) => {
    options = Object.assign(
      {
        title: 'Are you sure?',
        text: 'Are you sure you want to do that?',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes',
        icon: 'warning'
      },
      options
    )

    alert.value = Swal.fire(options).then(callback)
  }

  return { alertSuccess, alertError, alertConfirm }
}

export default useSweetAlert