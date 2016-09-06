<?php

Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::resource('block', 'BlockBackend');
});