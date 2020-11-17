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
            'public/dtTables/jquery.dataTables.min.js',
            'public/dtTables/dataTables.buttons.min.js',
                    
            //sweetalert2
            'public/js/sweetalert2.all.min.js',
        ],
        'public/js/scripts.js')
    .js('resources/js/app.js', 'public/js')
    //.sass('resources/sass/app.scss', 'public/css');
    .styles([
        'public/dtTables/css/jquery.dataTables.min.css',
        'public/dtTables/css/buttons.dataTables.min.css'
    ], 'public/css/all.css');
