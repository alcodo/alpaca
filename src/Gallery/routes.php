<?php

if (isLaravelVersion5_3()) {
    Route::group(['as' => 'backend.'], function () {
        Route::resource('/backend/gallery', 'GalleryBackend');
    });
} else {
    Route::resource('/backend/gallery', 'GalleryBackend');
}
