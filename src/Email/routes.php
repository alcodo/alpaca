<?php

Route::group(['as' => 'backend.'], function () {
    Route::get('/backend/email', 'EmailController@index');
    Route::get('/backend/email/register', 'EmailController@register');
    Route::get('/backend/email/passwort_reset', 'EmailController@passwort_reset');
});
