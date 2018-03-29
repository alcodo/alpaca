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
        /**
         * Category
         */
        \Alpaca\Support\CategoryCache::get()->map(function ($category) {
            Route::get($category->path, function () use ($category) {
                $controller = new \Alpaca\Controllers\CategoryController();

                return $controller->show($category);
            });
        });

        /*
         * Page.
         */
        \Alpaca\Support\Page\PageCache::get()->map(function ($page) {
            Route::get($page->path, function () use ($page) {
                $controller = new \Alpaca\Controllers\PageController();

                return $controller->show($page);
            });
        });

        /**
         * Redirect
         */
        \Alpaca\Support\Redirect\RedirectCache::get()->map(function ($redirect) {
            Route::get($redirect->from, function () use ($redirect) {
                $controller = new \Alpaca\Controllers\RedirectController();

                return $controller->show($redirect);
            });
        });
    } catch (Illuminate\Database\QueryException $e) {
    }
});
