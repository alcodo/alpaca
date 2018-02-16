<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo($permission): bool
    {
        $key = $this->slug.'.'.$permission;

        return app('Alpaca\Support\Guard')->hasPermission($key);
    }
}
