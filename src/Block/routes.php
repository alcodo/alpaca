<?php

if (isLaravelVersion5_3()) {

    Route::group(['as' => 'backend.'], function () {
        Route::resource('/backend/block', 'BlockBackend');
    });

} else {

    Route::resource('/backend/block', 'BlockBackend');

}