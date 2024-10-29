import {initFormDelete, initFormPost, initFormValidation} from "../components/form-data.js";
import initImagePreview from "../components/image-preview.js";
import initRefreshData from "../components/refresh-data.js";

let userForm = $('#user-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')

One.helpersOnLoad(['jq-validation', 'jq-select2'])

$('#role').select2({
    placeholder: 'Select Role',
    dropdownParent: document.querySelector($('#role').data('container') || '#form-modal'),
})

// Form Validation
const userFormRules = {
  name: {
    required: true,
    minlength: 3
  },
  role: {
    required: true
  },
}
initFormValidation(userForm, userFormRules)

// Datatable
const dtTable =$('#user-table').DataTable({
    processing: false,
    serverSide: true,
    ajax: {
        url: `${BASE_URL}/user/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-user')
    }
})

// Show Data Form Modal Edit or Create
$(formModal).on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  
  // Set modal title and form values
  $(this).find('.block-title').text(button.data('id') ? 'Edit' : 'Create')
  $(this).find('#id').val(button.data('id') || '')
  $(this).find('#name').val(button.data('name') || '')
  $(this).find('#email').val(button.data('email') || '')
  $(this).find('#role').val(button.data('role') || '').trigger('change')
  $(this).find('#status').prop('checked', button.data('status') === 1)
  if (button.data('image')) {
    $(this).find('#image-preview').attr('src', `${BASE_URL}/storage/images/user/${button.data('image') || ''}`)
  }else{
    $(this).find('#image-preview').attr('src', '')
  }
});

// Reset Form when modal closed
$(formModal).on('hidden.bs.modal', function () {
    $(userForm).validate().resetForm()
    $(userForm).find('#image').val('')
})

// Submit Form
$(userForm).on('submit', function (e) {
    e.preventDefault()
    if (!$(this).valid()) {
        return
    }
    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/user/store`
    const urlUpdate = `${BASE_URL}/user/update/${id}`
    const url = id ? urlUpdate : urlStore
    const fd = new FormData($(this)[0]);
    initFormPost(this, fd, url, dtTable, formModal)
});

// Delete Data
dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/user/destroy/${id}`
    initFormDelete(url, dtTable)
})

// Refresh Data
initRefreshData(btnRefresh, dtTable, '#block-user')
initImagePreview('#image', '#image-preview')
