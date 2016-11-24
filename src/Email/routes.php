<?php

Route::group(['as' => 'backend.'], function () {
    Route::resource('backend/email', 'EmailController', ['only' => [
        'index', 'show',
    ]]);
});
