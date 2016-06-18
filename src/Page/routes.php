<?php

Route::group(['namespace' => 'Alpaca\Page\Controllers'], function () {

    Route::resource('/backend/page', 'PageBackend');
    Route::resource('/backend/topic', 'TopicBackend');
    Route::resource('/backend/category', 'CategoryBackend');

    // config
    $categoryPrefix = config('page.categoryPrefix');

    // category with/without topic
    Route::get('/{topic}/'.$categoryPrefix.'/{categorySlug}', ['as' => 'category.show.topic', 'uses' => 'CategoryFront@showTopic']);
    Route::get('/'.$categoryPrefix.'/{categorySlug}', ['as' => 'category.show', 'uses' => 'CategoryFront@show']);

    // page with/without topic
    Route::get('/{topicSlug}/{pageSlug}', ['as' => 'page.show.topic', 'uses' => 'PageFront@showTopic']);
    Route::get('/{pageSlug}', ['as' => 'page.show', 'uses' => 'PageFront@show']);

    // front page
    Route::get('/', ['as' => 'page.frontpage', 'uses' => 'PageFront@showFrontPage']);

});