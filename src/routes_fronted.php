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
        \Alpaca\Support\CategoryCache::get()->map(function ($category) {
            Route::get($category->path, function () use ($category) {
                $controller = new \Alpaca\Controllers\CategoryController();

                return $controller->show($category);
            });
        });

        /**
         * Page.
         */
        \Alpaca\Support\PageCache::get()->map(function ($page) {
            Route::get($page->path, function () use ($page) {
                $controller = new \Alpaca\Controllers\PageController();

                return $controller->show($page);
            });
        });
    } catch (Illuminate\Database\QueryException $e) {
    }
});
