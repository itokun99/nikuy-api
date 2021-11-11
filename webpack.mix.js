const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix web
mix
    .sass('resources/sass/web/global/index.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/course-info.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/course.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/event.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/home.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/membership.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/payment.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/profile.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/register.scss', "public/assets/web/css")
    .sass('resources/sass/web/pages/transaksi.scss', "public/assets/web/css");

mix
    .js('resources/js/web/react/index.jsx', "public/assets/web/js")
    .react();

mix
    .copyDirectory('resources/vendor/web', 'public/assets/web/vendor');

// mix admin
// mix.js('resources/js/admin/global/index.js', 'public/assets/admin/js/')
//     .js('resources/js/admin/components/tinymce.js', 'public/assets/admin/js/')
//     .sass('resources/sass/admin/global/index.scss', 'public/assets/admin/css')
//     .version();
// mix
//     .js('resources/js/admin/microservices/ms-event-author-select/index.jsx', "public/assets/admin/js/microservices/ms-event-author-select")
//     .js('resources/js/admin/microservices/ms-input-upload/index.jsx', "public/assets/admin/js/microservices/ms-input-upload")
//     .react();
// mix.copyDirectory('resources/vendor/admin', 'public/assets/admin/vendor');