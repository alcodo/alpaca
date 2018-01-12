<?php

Route::group([
    'as' => 'backend.',
    'middleware' => [
        'web',
//        'auth',
        'alpaca',
    ],
], function () {

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

    // Block
    Route::resource('/backend/block', \Alpaca\Controllers\BlockController::class, ['except' => ['show']]);

    // Gallery
    Route::resource('/backend/image', \Alpaca\Controllers\ImageController::class, ['except' => [
        'show', 'create', 'edit'
    ]]);

    // User
    Route::resource('/backend/user', \Alpaca\Controllers\UserController::class, ['except' => [
        'show', 'create', 'edit'
    ]]);
//    Route::resource('/backend/role', 'RoleBackend');
//    Route::resource('/backend/permission', 'PermissionBackend');

    // Page
    Route::resource('/backend/page', \Alpaca\Controllers\PageController::class);
    Route::resource('/backend/category', \Alpaca\Controllers\CategoryController::class);

});