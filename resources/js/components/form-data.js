import sweetAlert from "@/helper/sweetalert.js";

function initFormValidation(formSelector, rules) {
  $(formSelector).validate({
    rules: rules,
    highlight: function(element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function(element) {
      $(element).removeClass('is-invalid');
    }
  })
}

function initFormPost(formSelector = null, formData, formUrl, dtTable, formModal = null) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': CSRF_TOKEN
    }
  })
  $.post({
    url: formUrl,
    data: formData,
    processData: false,
    contentType: false
  })
    .done(result => {
      sweetAlert(result.status, result.message)
      if (formModal) {
        $(formModal).modal('hide')
      }
      if (formSelector) {
        $(formSelector)[0].reset()
      }
    })
    .always(function() {
      dtTable.ajax.reload(null, false)
    });
}

function initFormDelete(formUrl, dtTable) {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      })
      $.post({
        url: formUrl
      })
        .done(result => {
          sweetAlert(result.status, result.message)
          dtTable.ajax.reload(null, false)
        })
    }
  })
}


export {
  initFormValidation,
  initFormPost,
  initFormDelete
}
