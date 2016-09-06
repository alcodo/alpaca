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

Route::resource('/backend/user', 'UserController', ['names' => getResourceRouteName('backend.user')]);
Route::resource('/backend/role', 'RoleController', ['names' => getResourceRouteName('backend.role')]);
Route::resource('/backend/permission', 'PermissionController', ['names' => getResourceRouteName('backend.permission')]);
