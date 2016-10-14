<?php

Route::group(['as' => 'backend.'], function () {
    Route::resource('/backend/gallery', 'GalleryBackend');
});
