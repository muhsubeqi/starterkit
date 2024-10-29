function initRefreshData(element, dtTable, blockElement) {
    element.on('click', function () {
        dtTable.ajax.reload(null, false)
        One.block('state_loading', blockElement)
    })
}

export default initRefreshData