<?php

Route::group(['namespace' => 'Alpaca\Page\Controllers'], function () {

    Route::resource('/backend/category', 'CategoryBackend');
    Route::resource('/backend/page', 'PageBackend');

    // category show
    Route::get('/category/{slug}', ['as' => 'category.show', 'uses' => 'CategoryFront@show']);

    // page show
    Route::get('{slug?}', ['as' => 'page.show', 'uses' => 'PageFront@show'])->where('slug', '(.*)');
});
