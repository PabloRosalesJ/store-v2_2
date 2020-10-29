const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |"C:\laragon\www\store\public\js\sweetalert2.all.min.js"
 */

mix
    .scripts(
        [
            'public/js/vendor-all.min.js',
            'public/js/plugins/bootstrap.min.js',
            'public/js/ripple.js',
            'public/js/pcoded.min.js',
            //dataTables
            'public/js/plugins/jquery.dataTables.min.js',
            'public/js/plugins/dataTables.bootstrap4.min.js',
            
            'public/js/plugins/buttons.colVis.min.js',
            'public/js/plugins/buttons.print.min.js',
            'public/js/plugins/pdfmake.min.js',
            'public/js/plugins/jszip.min.js',
            'public/js/plugins/dataTables.buttons.min.js',
            'public/js/plugins/buttons.html5.min.js',
            'public/js/plugins/buttons.bootstrap4.min.js',
            'public/js/pages/data-export-custom.js',

            'public/js/sweetalert2.all.min.js',
        ],
        'public/js/scripts.js')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
