<?php

namespace Alpaca\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = [
        'name',
        'slug',
        'display_name',
        'description'
    ];
}
