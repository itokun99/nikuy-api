try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('popper.js').default;
    require('bootstrap');
    require('toastr');
} catch (e) {
    console.log('error: ' + e.message);
}