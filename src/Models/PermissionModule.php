<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    protected $table = 'permission_module';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
