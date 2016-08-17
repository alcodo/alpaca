var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

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

elixir(function(mix) {
    mix.sass('../../../alpaca/resources/sass/style.scss', 'public/assets/theme/style.css');
    // mix.sass('style.scss', 'public/assets/theme/style.css');
    //mix.rubySass('style.scss', 'public/assets/theme/style.css');

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
        '../../../vendor/alcodo/alpaca/src/resources/js-lib/bootstrap-confirmation.js',
        '../../../vendor/alcodo/alpaca/src/resources/js-lib/jquery.bootstrap-autohidingnavbar.js',

        // js
        '../../../vendor/alcodo/alpaca/src/resources/js/navbar.js',
        '../../../vendor/alcodo/alpaca/src/resources/js/dataTables_languages.js',
        '../../../vendor/alcodo/alpaca/src/resources/js/dataTables.js',
        '../../../vendor/alcodo/alpaca/src/resources/js/confirm-button.js',
        '../../../vendor/alcodo/alpaca/src/resources/js/page.js',
        '../../../vendor/alcodo/alpaca/src/resources/js/select.js'
    ], 'public/assets/theme/script.js');

    // Version
    mix.version([
        'assets/theme/style.css',
        'assets/theme/script.js'
    ]);
});
