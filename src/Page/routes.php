<?php

Route::group(['namespace' => 'Alpaca\Page\Controllers'], function () {

//
//    // index
//    Route::get('/page/category', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
//
//    // create
//    Route::get('/page/category/create', ['as' => 'category.create', 'uses' => 'CategoryController@create']);
//    Route::post('/page/category/create', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
//
//    // edit
//    Route::get('/page/category/{page}/edit', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
//    Route::put('/page/category/{page}', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
//    Route::patch('/page/category/{page}', ['as' => 'category.patch', 'uses' => 'CategoryController@update']);
//
//    // delete
//    Route::delete('/page/category/{page}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
//
//    // show
//    Route::get('/category/{slug}', ['as' => 'category.show', 'uses' => 'CategoryController@show']);
////    Route::resource('/page/category', 'CategoryController');
//
//
//    // index
//    Route::get('/page', ['as' => 'page.index', 'uses' => 'PageController@index']);
//
//    // create
//    Route::get('/page/create', ['as' => 'page.create', 'uses' => 'PageController@create']);
//    Route::post('/page/create', ['as' => 'page.store', 'uses' => 'PageController@store']);
//
//    // edit
//    Route::get('/page/{page}/edit', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
//    Route::put('/page/{page}', ['as' => 'page.update', 'uses' => 'PageController@update']);
//    Route::patch('/page/{page}', ['as' => 'page.patch', 'uses' => 'PageController@update']);
//
//    // delete
//    Route::delete('/page/{page}', ['as' => 'page.destroy', 'uses' => 'PageController@destroy']);
//

    Route::resource('/backend/category', 'CategoryBackend');
    Route::resource('/backend/page', 'PageBackend');
//    Route::resource('/video', 'VideoFront', ['only' => ['index', 'show']]);

    // show
    Route::get('/{path?}', ['as' => 'page.show', 'uses' => 'PageFront@show'])->where('path', '(.*)');
});
