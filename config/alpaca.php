<?php

return [

    'recaptcha' => [
        'public' => env('RECAPTCHA_PUBLIC'),
        'secret' => env('RECAPTCHA_SECRET'),
    ],

    /*
     * Sitemap page
     */
    'sitemap' => [
        'path' => '/sitemap',
    ],

    /*
     * Contact form
     */
    'contact' => [
        'path' => '/contact',
    ],

    /*
     * Cookie consent footer
     */
    'cookieconsent' => [
        'path' => '/imprint',
    ],

];
