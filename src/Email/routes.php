<?php

Route::group(['as' => 'backend.'], function () {
    Route::get('/backend/email', 'EmailController@index')->name('email.index');
    Route::get('/backend/email/register', 'EmailController@register')->name('email.register');
    Route::get('/backend/email/passwort_reset', 'EmailController@passwort_reset')->name('email.passwort_reset');
});
