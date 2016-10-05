<?php

if (isLaravelVersion5_3()) {

    Route::group(['as' => 'backend.'], function () {
        Route::group(['as' => 'menu.{menuId}.'], function () {
            Route::resource('/backend/menu/{menuId}/item', 'ItemBackend');
        });
        Route::resource('/backend/menu', 'MenuBackend');
    });

} else {

    Route::resource('/backend/menu/{menuId}/item', 'ItemBackend');
    Route::resource('/backend/menu', 'MenuBackend');

}