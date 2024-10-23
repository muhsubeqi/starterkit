import sweetAlert from "../helper/sweetalert"
import {initFormDelete, initFormPost, initFormValidation} from "../components/form-data.js";

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
  let id = button.data('id')
  let name = button.data('name') || ''
  let email = button.data('email') || ''
  let role = button.data('role') || ''
  let status = button.data('status') === 1

  // Set modal title and form values
  $(this).find('.modal-title').text(id ? 'Edit' : 'Create')
  $(this).find('#id').val(id || '')
  $(this).find('#name').val(name)
  $(this).find('#email').val(email)
  $(this).find('#role').val(role).change()
  $(this).find('#status').prop('checked', status)
});

// Reset Form when modal closed
$(formModal).on('hidden.bs.modal', function () {
    $(userForm).validate().resetForm()
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

dtTable.on('change', '.btn-status', function () {
    const id = $(this).data('id')
    const status = $(this).val()
    const url = `${BASE_URL}/user/status/${id}`
    initFormPost(null, {status: status}, url, dtTable)
})


// Refresh Data
btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-user')
})
