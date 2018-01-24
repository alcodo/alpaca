<?php

namespace Alpaca\Models;

class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = ['name', 'display_name', 'description'];
}
