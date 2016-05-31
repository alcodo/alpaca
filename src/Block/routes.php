<?php

Route::group(['namespace' => 'Alpaca\Block\Controllers'], function () {
    Route::resource('/backend/block', 'BlockBackend');
});
