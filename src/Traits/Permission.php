<?php

namespace Alpaca\Traits;

use Alpaca\Models\Role;

trait Permission
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
