import sweetAlert from "../helper/sweetalert"

let userForm = $('#user-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')

$('#role').select2({
    placeholder: 'Select Role',
    dropdownParent: document.querySelector($('#role').data('container') || '#form-modal'),
})

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

$(formModal).on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) 
    let id = button.data('id'); 
    let name = button.data('name')
    let email = button.data('email')
    let role = button.data('role')
    let status = button.data('status')
    
    // Set modal title and form values (if it's edit)
    if (id) {
        $(this).find('.modal-title').text('Edit');
        $(this).find('#id').val(id);
        $(this).find('#name').val(name);
        $(this).find('#email').val(email);
        $(this).find('#role').val(role).change();
        if(status == 1){
            $(this).find('#status').prop('checked', true);
        }else{
            $(this).find('#status').prop('checked', false);
        }
    }else{
        $(this).find('.modal-title').text('Create');
        $(this).find('#id').val('');
        $(this).find('#name').val('');
        $(this).find('#email').val('');
        $(this).find('#role').val('').change();
        $(this).find('#status').prop('checked', true);
    }
});

$(document).ready(function () {
    One.helpers("jq-validation")
    $(userForm).validate({
        rules: {
            name: { 
                required: true,
                minlength: 3
            },
            role: { 
                required: true
            },
        },
        highlightElement: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlightElement: function(element) {
            $(element).removeClass('is-invalid');
        }
    })
});

$(formModal).on('hidden.bs.modal', function () {
    $(userForm).validate().resetForm()
})

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    })
    $.post({
            url: url,
            data: fd,
            processData: false,
            contentType: false
        })
        .done(result => {
            sweetAlert(result.status, result.message)
            $(formModal).modal('hide')
            $(this)[0].reset()
        })
        .always(function() {
            dtTable.ajax.reload(null, false)
        });
});

dtTable.on('click', '.btn-delete', function () {
    const id = $(this).data('id')
    const url = `${BASE_URL}/user/destroy/${id}`
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
                    url: url
                })
                .done(result => {
                    sweetAlert(result.status, result.message)
                    dtTable.ajax.reload(null, false)
                })
        }
    })
})

dtTable.on('change', '.btn-status', function () {
    const id = $(this).data('id')
    const status = $(this).val()
    const url = `${BASE_URL}/user/status/${id}`
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    })
    $.post({
            url: url,
            data: {
                status: status
            }
        })
        .done(result => {
            sweetAlert(result.status, result.message)
            dtTable.ajax.reload(null, false)
        })
})

btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-user')
})