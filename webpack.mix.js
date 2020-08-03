const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/core.scss', 'public/css')
    .js('resources/js/bundles/global.js', 'public/js')
    .js('resources/js/bundles/header.js', 'public/js')
    .js('resources/js/bundles/admin.js', 'public/js');

   