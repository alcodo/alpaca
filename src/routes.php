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

    // Email Template
    Route::resource('/backend/email-template', '\Alpaca\Controllers\EmailTemplateController', ['only' => [
        'index', 'show',
    ]]);

    // Menu
    Route::resource('/backend/menu/{menu}/link', \Alpaca\Controllers\MenuLinkController::class, ['except' => [
        'index', 'show', 'create', 'edit'
    ]]);
    Route::resource('/backend/menu', \Alpaca\Controllers\MenuController::class, ['except' => [
        'show', 'create', 'edit'
    ]]);


//Route::middleware(['web'])->namespace('Alpaca\Controllers')->group(function () {
//Route::middleware(['web', 'trimStrings'])->namespace('Alpaca\Controllers')->group(function () {


//Route::group(['as' => 'backend.', 'middleware' => 'auth'], function () {
//    Route::resource('/backend/page', 'PageBackend');
//    Route::resource('/backend/topic', 'TopicBackend');
//    Route::resource('/backend/category', 'CategoryBackend');
//});
//
//// config
//$categoryPrefix = config('page.categoryPrefix');
//
//// category with/without topic
//Route::get('/{topic}/'.$categoryPrefix.'/{categorySlug}', ['as' => 'category.show.topic', 'uses' => 'CategoryFront@showTopic']);
//Route::get('/'.$categoryPrefix.'/{categorySlug}', ['as' => 'category.show', 'uses' => 'CategoryFront@show']);
//
//// page with/without topic
//Route::get('/{topicSlug}/{pageSlug}', ['as' => 'page.show.topic', 'uses' => 'PageFront@showTopic']);
//Route::get('/{pageSlug}', ['as' => 'page.show', 'uses' => 'PageFront@show']);
//
//// front page
//Route::get('/', ['as' => 'page.frontpage', 'uses' => 'PageFront@showFrontPage']);

    /**
     * Categorie
     */
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

    Route::resource('/backend/page', \Alpaca\Controllers\PageController::class);
    Route::resource('/backend/category', \Alpaca\Controllers\CategoryController::class);

});