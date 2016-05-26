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
    mix.sass('style.scss', 'public/assets/theme/style.css');
    //mix.rubySass('style.scss', 'public/assets/theme/style.css');

    // js
    mix.scripts([
        // scripts
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        '../../../node_modules/magnific-popup/dist/jquery.magnific-popup.js',
        '../../../node_modules/summernote/dist/summernote.js',
        '../../../node_modules/summernote/dist/lang/summernote-de-DE.js',
        '../../../node_modules/datatables.net/js/jquery.dataTables.js',
        '../../../node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
        '../../../node_modules/select2/dist/js/select2.js',
        '../../../node_modules/jquery-treegrid/js/jquery.treegrid.js',
        '../../../node_modules/jquery-treegrid/js/jquery.treegrid.bootstrap3.js',
        'lib/bootstrap-confirmation.js',
        'lib/jquery.bootstrap-autohidingnavbar.js',
        'navbar.js',
        'dataTables_languages.js',
        'dataTables.js',
        'confirm-button.js',
        'page.js',
        'select.js'
    ], 'public/assets/theme/script.js');

    // Version
    mix.version([
        'assets/theme/style.css',
        'assets/theme/script.js'
    ]);
});
