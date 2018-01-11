<?php

Route::group([
    'middleware' => [
        'web',
        'alpaca',
    ],
], function () {

    // Sitemap
    Route::get('/sitemap', '\Alpaca\Controllers\SitemapController@html');
    Route::get('/sitemap.xml', '\Alpaca\Controllers\SitemapController@xml');

    // Contact
    Route::get('/contact', ['as' => 'contact.show', 'uses' => '\Alpaca\Controllers\ContactController@show']);
    Route::post('/contact', ['as' => 'contact.send', 'uses' => '\Alpaca\Controllers\ContactController@send']);

    // User
    Auth::routes();
    Route::get('/register/verify/{token}', 'Auth\RegisterController@verify');
    Route::get('/dashboard', 'DashboardController@index');


    // Page
    try {
        $categories = \Alpaca\Models\Category::all();

        $categories->map(function ($category) {

            Route::get($category->path, function () use ($category) {
                $controller = new \Alpaca\Controllers\CategoryController();
                return $controller->show($category);
            });
        });


        /**
         * Page
         */
        $pages = \Alpaca\Models\Page::all();

        $pages->map(function ($page) {

            Route::get($page->path, function () use ($page) {
                $controller = new \Alpaca\Controllers\PageController();
                return $controller->show($page);
            });
        });

    } catch (Illuminate\Database\QueryException $e) {
    }

});