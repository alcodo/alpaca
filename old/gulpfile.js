const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    
    // sass
    mix.sass('style.scss', 'public/assets/theme/style.css')

    // js
    mix.scripts([
        // dependency
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        '../../../node_modules/magnific-popup/dist/jquery.magnific-popup.js',
        '../../../node_modules/summernote/dist/summernote.js',
        '../../../node_modules/summernote/dist/lang/summernote-de-DE.js',
        '../../../node_modules/datatables.net/js/jquery.dataTables.js',
        '../../../node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        '../../../node_modules/select2/dist/js/select2.js',
        '../../../node_modules/jquery-treegrid/js/jquery.treegrid.js',
        '../../../node_modules/jquery-treegrid/js/jquery.treegrid.bootstrap3.js',

        // libs
        '../../../vendor/alcodo/alpaca/resources/javascript/libraries/bootstrap-confirmation.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/libraries/jquery.bootstrap-autohidingnavbar.js',

        // js
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/navbar.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/dataTables_languages.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/dataTables.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/confirm-button.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/page.js',
        '../../../vendor/alcodo/alpaca/resources/javascript/alpaca/select.js'
    ], 'public/assets/theme/script.js');

    // Version
    mix.version([
        'assets/theme/style.css',
        'assets/theme/script.js'
    ]);

});
