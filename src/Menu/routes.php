<?php

Route::group(['namespace' => 'Alpaca\Menu\Controllers'], function () {

    Route::resource('/backend/menu/{menuId}/item', 'ItemBackend');
    Route::resource('/backend/menu', 'MenuBackend');
});
