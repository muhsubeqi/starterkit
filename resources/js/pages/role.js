import {initFormValidation, initFormDelete, initFormPost} from "../components/form-data.js";

let roleForm = $('#role-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')

const roleFormRules = {
    name: {
        required: true,
        minlength: 3
    },
}
initFormValidation(roleForm, roleFormRules)

const dtTable =$('#role-table').DataTable({
    processing: false,
    serverSide: true,
    ajax: {
        url: `${BASE_URL}/role/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-role')
    }
})

// Trigger the modal with data (assuming you have a mechanism to pass data)
$(formModal).on('show.bs.modal', function (event) {
  const button = $(event.relatedTarget)
  const id = button.data('id')
  const name = button.data('name')

  // Set modal title and form values
  const modalTitle = id ? 'Edit' : 'Create'
  $(this).find('.modal-title').text(modalTitle)
  $(this).find('#id').val(id || '')
  $(this).find('#name').val(name || '')
});

$(formModal).on('hidden.bs.modal', function () {
    $(roleForm).validate().resetForm()
})

$(roleForm).on('submit', function (e) {
    e.preventDefault()

    if (!$(this).valid()) {
        return
    }

    const id = $(this).find('#id').val();
    const urlStore = `${BASE_URL}/role/store`
    const urlUpdate = `${BASE_URL}/role/update/${id}`

    const url = id ? urlUpdate : urlStore
    const fd = new FormData($(this)[0]);
    initFormPost(this, fd, url, dtTable, formModal)
});

dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/role/destroy/${id}`
    initFormDelete(url, dtTable)
})

btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-role')
})

$('#permission-all').click(function(){
    if ($(this).is(':checked')) {
      $('input[ type=checkbox]').prop('checked',true)
    }else{
        $('input[ type=checkbox]').prop('checked',false)
    }
})

$('#role-permission-modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let id = button.data('id')
    let rolePermissions = button.data('role-permissions')
    let permissions = PERMISSIONS
    $('#permission-group').empty()
    permissions.forEach(item => {
        let content = ''
        content += `
                <div class="col-3">
                    <div class="form-check">
                        <label class="form-check-label" for="group-${item.group_name}">${item.group_name}</label>
                    </div>
                </div>
                <div class="col-9" id="permission-item">`
        item.permissions.forEach(item => {
            let checked = rolePermissions.includes(item.id) ? 'checked' : ''
            content +=`<div class="form-check">
                            <input class="form-check-input permission" type="checkbox" value="${item.id}" id="permission-${item.id}"
                                name="permission[]" ${checked}>
                            <label class="form-check-label" for="permission-${item.id}">${item.name}</label>
                        </div>`
                    })
            content +=`</div><hr>`
        $('#permission-group').append(content)
    })

    if ($('.permission:checked').length == $('.permission').length) {
        $('#permission-all').prop('checked',true)
    }else{
        $('#permission-all').prop('checked',false)
    }

    // Set modal title and form values (if it's edit)
    $(this).find('#id').val(id)
});

$('#role-permission-form').on('submit', function (e) {
    e.preventDefault()

    const id = $(this).find('#id').val()
    const url = `${BASE_URL}/role/permission/${id}`
    const fd = new FormData($(this)[0])
    initFormPost(this, fd, url, dtTable, '#role-permission-modal')
});
