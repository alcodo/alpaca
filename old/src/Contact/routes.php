<?php

// config
$prefix = config('contact.prefix');
if (empty($prefix)) {
    $prefix = 'contact';
}

Route::get($prefix, ['as' => 'contact.show', 'uses' => 'ContactController@show']);
Route::post($prefix.'/send', ['as' => 'contact.send', 'uses' => 'ContactController@send']);
