import sweetAlert from "../helper/sweetalert"

let roleForm = $('#role-form')
let formModal = $('#form-modal')
const btnRefresh = $('#btn-refresh')

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
    let button = $(event.relatedTarget) 
    let id = button.data('id'); 
    let name = button.data('name')
    // Set modal title and form values (if it's edit)
    if (id) {
        $(this).find('.modal-title').text('Edit');
        $(this).find('#id').val(id);
        $(this).find('#name').val(name);
    }else{
        $(this).find('.modal-title').text('Create');
        $(this).find('#id').val('');
        $(this).find('#name').val('');
    }
});

$(document).ready(function () {
    $(roleForm).validate({
        rules: {
        name: { 
            required: true,
            minlength: 3
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
    console.log(id);
    const url = `${BASE_URL}/role/destroy/${id}`
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
            console.log(result);
            sweetAlert(result.status, result.message)
            $('#role-permission-modal').modal('hide')
            $(this)[0].reset()
        })
        .always(function() {
            dtTable.ajax.reload(null, false)
        });
});
