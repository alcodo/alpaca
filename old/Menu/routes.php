<?php

Route::group(['as' => 'backend.', 'middleware' => 'auth'], function () {
    Route::group(['as' => 'menu.{menuId}.'], function () {
        Route::resource('/backend/menu/{menuId}/item', 'ItemBackend');
    });
    Route::resource('/backend/menu', 'MenuBackend');
});
