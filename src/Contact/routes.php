<?php

// config
$prefix = config('contact.prefix');
if (empty($prefix)) {
    throw new Exception('Contact config isn\'t set');
}

Route::get($prefix, ['as' => 'contact.show', 'uses' => 'ContactController@show']);
Route::post($prefix . '/send', ['as' => 'contact.send', 'uses' => 'ContactController@send']);
