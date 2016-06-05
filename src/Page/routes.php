<?php

Route::group(['namespace' => 'Alpaca\Page\Controllers'], function () {

    Route::resource('/backend/category', 'CategoryBackend');
    Route::resource('/backend/page', 'PageBackend');

    // fronted show
    $pagePrefix = config('page.prefix');

    // category
    Route::get($pagePrefix . '/{categorySlug}', ['as' => 'category.show', 'uses' => 'CategoryFront@show']);

    // page with category
    Route::get($pagePrefix . '/{categorySlug}/{pageSlug}', ['as' => 'page.show', 'uses' => 'PageFront@show']);

    // front page
    Route::get('/', ['as' => 'page.frontpage', 'uses' => 'PageFront@showFrontPage']);
});