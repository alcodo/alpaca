<?php

Route::resource('/backend/block', 'BlockBackend', ['names' => getResourceRouteName('backend.block')]);