<?php

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::group(['prefix' => 'menu/{menuId}', 'as' => 'menu.{menuId}.'], function () {
        Route::resource('item', 'ItemBackend');
    });

    Route::resource('menu', 'MenuBackend');
});