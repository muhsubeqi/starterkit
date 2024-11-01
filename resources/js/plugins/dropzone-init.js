import {Dropzone} from 'dropzone'

try {
    window.Dropzone = Dropzone
} catch (e) {
    console.log(e)
}
