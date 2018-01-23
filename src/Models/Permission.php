<?php

namespace Alpaca\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name',
        'slug',
        'display_name',
        'description'
    ];
}
