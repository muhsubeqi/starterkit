import jQuery from 'jquery';
import './bootstrap';

window.jQuery = window.$ = jQuery

window.BASE_URL = $('meta[name="base-url"]').attr('content')
window.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')