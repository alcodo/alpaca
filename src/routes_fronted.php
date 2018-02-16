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

    if (config('app.env') === 'testing') {
        // Authentication Routes...
        Route::get('login', '\Alpaca\Controllers\Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', '\Alpaca\Controllers\Auth\LoginController@login');
        Route::post('logout', '\Alpaca\Controllers\Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', '\Alpaca\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', '\Alpaca\Controllers\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', '\Alpaca\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', '\Alpaca\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', '\Alpaca\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', '\Alpaca\Controllers\Auth\ResetPasswordController@reset');
    }

    // Verify
    Route::get('/register/verify/{token}', '\Alpaca\Controllers\VerifyController@verify');

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
         * Page.
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
