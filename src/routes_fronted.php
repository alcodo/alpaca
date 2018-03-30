<?php

Route::group([
    'middleware' => [
        'web',
        'alpaca',
    ],
], function () {

    // Sitemap
    Route::get(config('alpaca.sitemap.path'), '\Alpaca\Controllers\SitemapController@html');
    Route::get('/sitemap.xml', '\Alpaca\Controllers\SitemapController@xml');

    // Contact
    Route::get(config('alpaca.contact.path'), [
        'as' => 'contact.show', 'uses' => '\Alpaca\Controllers\ContactController@show',
    ]);
    Route::post(config('alpaca.contact.path'), [
        'as' => 'contact.send', 'uses' => '\Alpaca\Controllers\ContactController@send',
    ]);

    // Verify
    Route::get('/register/verify/{token}', '\Alpaca\Controllers\VerifyController@verify');

    try {
        /*
         * Category
         */
        \Alpaca\Support\CategoryCache::get()->map(function ($path, $id) {
            Route::get($path, function () use ($id) {
                $controller = new \Alpaca\Controllers\CategoryController();

                return $controller->show($id);
            });
        });

        /*
         * Page.
         */
        \Alpaca\Support\Page\PageCache::get()->map(function ($path, $id) {
            Route::get($path, function () use ($id) {
                $controller = new \Alpaca\Controllers\PageController();

                return $controller->show($id);
            });
        });

        /*
         * Redirect
         */
        \Alpaca\Support\Redirect\RedirectCache::get()->map(function ($from, $id) {
            Route::get($from, function () use ($id) {
                $controller = new \Alpaca\Controllers\RedirectController();

                return $controller->show($id);
            });
        });
    } catch (Illuminate\Database\QueryException $e) {
    }
});
