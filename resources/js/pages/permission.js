const btnRefresh = $('#btn-refresh')

const dtTable =$('#permission-table').DataTable({
    processing: false,
    serverSide: true,
    ajax: {
        url: `${BASE_URL}/permission/list`,
    },
    columns: COLUMNS,
    drawCallback: function () {
        One.block('state_normal', '#block-permission')
    }
})

btnRefresh.on('click', function () {
    dtTable.ajax.reload(null, false)
    One.block('state_loading', '#block-permission')
})

