<?php

Route::group(['as' => 'backend.', 'middleware' => 'auth'], function () {
    Route::resource('/backend/block', 'BlockBackend');
});
