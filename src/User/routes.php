<?php

// Authentication routes...
Route::get('/login', ['as' => 'user.login', 'uses' => 'AuthController@getLogin']);
Route::post('/login', 'AuthController@postLogin');
Route::get('/logout', 'AuthController@getLogout');

// Registration routes..
Route::get('/register', ['as' => 'user.register', 'uses' => 'AuthController@getRegister']);
Route::post('/register', 'AuthController@postRegister');

// TODO
// Password forgotten
// Edit own user profile

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});
