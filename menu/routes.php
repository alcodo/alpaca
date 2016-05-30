<?php

Route::group(['namespace' => 'Alcodo\Menu\Controllers'], function () {

//    Route::resource('/menu/item', 'MenuItemController');
//
//    // create
//    Route::get('/menu/{menu}/create', ['as' => 'menu.item.create', 'uses' => 'MenuItemController@create']);
//    Route::post('/menu/{menu}/create', ['as' => 'menu.item.store', 'uses' => 'MenuItemController@store']);
//
//    // edit
//    Route::get('/menu/{menu}/{item}/edit', ['as' => 'menu.item.edit', 'uses' => 'MenuItemController@edit']);
//    Route::put('/menu/{menu}/{item}', ['as' => 'menu.item.update', 'uses' => 'MenuItemController@update']);
//    Route::patch('/menu/{menu}/{item}', ['as' => 'menu.item.patch', 'uses' => 'MenuItemController@update']);
//
//    // delete
//    Route::delete('/menu/{menu}/{item}/delete', ['as' => 'menu.item.destroy', 'uses' => 'MenuItemController@destroy']);

    Route::resource('/backend/menu/{menu}/item', 'ItemBackend');
    Route::resource('/backend/menu', 'MenuBackend');
});
