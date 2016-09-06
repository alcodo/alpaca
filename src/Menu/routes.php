<?php

Route::resource('/backend/menu/{menuId}/item', 'ItemBackend', ['names' => getResourceRouteName('backend.block.item')]);
Route::resource('/backend/menu', 'MenuBackend', ['names' => getResourceRouteName('backend.menu')]);
