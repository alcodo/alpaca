<?php

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::group(['as' => 'backend.', 'middleware' => 'auth'], function () {
    Route::resource('/backend/user', 'UserBackend');
    Route::resource('/backend/role', 'RoleBackend');
    Route::resource('/backend/permission', 'PermissionBackend');
});
