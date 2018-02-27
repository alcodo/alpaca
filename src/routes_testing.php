<?php

Route::group([
    'middleware' => [
        'web',
        'alpaca',
    ],
], function () {
    if (config('app.env') === 'testing') {
        // Authentication Routes...
        Route::get('login', '\Alpaca\Controllers\Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', '\Alpaca\Controllers\Auth\LoginController@login');
        Route::post('logout', '\Alpaca\Controllers\Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', '\Alpaca\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', '\Alpaca\Controllers\Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', '\Alpaca\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', '\Alpaca\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', '\Alpaca\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', '\Alpaca\Controllers\Auth\ResetPasswordController@reset');
    }
});
