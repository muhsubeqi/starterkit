function initImagePreview(element, preview) {
    $(element).on('change', function () {
        const file = this.files[0]
        const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = function () {
            $(preview).attr('src', reader.result)
        }
    })
}

export default initImagePreview