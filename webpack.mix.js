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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')

    .copy(
        'node_modules/bootstrap',
        'public/plugins/bootstrap'
    )
    .copy(
        'node_modules/jquery',
        'public/plugins/jquery'
    )
    .copy(
        'node_modules/@fortawesome/fontawesome-free',
        'public/plugins/fontawesome'
    )
    .copy(
        'node_modules/animate.css',
        'public/plugins/animate'
    )
    .copy(
        'resources/assets/backend',
        'public/assets/backend'
    )
    .copy(
        'node_modules/daterangepicker',
        'public/plugins/daterangepicker'
    )
    .copy(
        'node_modules/bootstrap-notify',
        'public/plugins/bootstrap-notify'
    )
    .copy(
        'node_modules/chart.js',
        'public/plugins/chart.js'
    );

