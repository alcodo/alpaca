<?php
//
Route::group(['namespace' => 'Alpaca\Page\Controllers'], function () {

    Route::resource('/backend/category', 'CategoryBackend');
    Route::resource('/backend/page', 'PageBackend');

    // fronted show

    // category
    Route::get('/{categorySlug}', ['as' => 'category.show', 'uses' => 'CategoryFront@show']);

    // page with category
    Route::get('/{categorySlug?}/{pageSlug}', ['as' => 'page.show', 'uses' => 'PageFront@show']);

    // front page
    Route::get('/', ['as' => 'page.show', 'uses' => 'PageFront@showFrontPage']);
});