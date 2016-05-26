<?php

Route::group(['namespace' => 'Alcodo\Block\Controllers'], function () {

    Route::resource('/backend/block', 'BlockBackend');

});