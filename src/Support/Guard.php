<?php

namespace Alpaca\Support;

use Alpaca\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Cache\Repository;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

class Guard
{
    /** @var \Illuminate\Contracts\Auth\Access\Gate */
    protected $gate;

    /** @var \Illuminate\Contracts\Cache\Repository */
    protected $cache;

    /** @var string */
    protected $cacheKey = 'permission.cache';

    public function __construct(Gate $gate, Repository $cache)
    {
        $this->gate = $gate;
        $this->cache = $cache;
    }

    public function registerPermissions(): void
    {
        $this->gate->before(function (Authenticatable $user, string $permissionSlug) {

            foreach ($user->roles->pluck('slug') as $roleSlug) {

                $ability = $roleSlug . '.' . $permissionSlug;

                if ($this->hasPermission($ability)) {
                    return true;
                }
            }

        });
    }

    public function hasPermission($ability): bool
    {
        return in_array($ability, $this->getPermissionFromCache());
    }

    public function refreshCache()
    {
        $this->cache->forget($this->cacheKey);
        $this->getPermissionFromCache();
    }

    public function getPermissionFromCache(): array
    {
        return $this->cache->rememberForever($this->cacheKey, function () {
            return $this->getPermissionFromDB();
        });
    }

    public function getPermissionFromDB(): array
    {
        $roles = Role::with('permissions')->get();

        return $roles->map(function ($rol) {

            // get all permissions
            return $rol->permissions
                ->map(function ($perm) use ($rol) {
                    return $rol->slug . '.' . $perm->slug;
                })
                ->all();

        })
            ->collapse()
            ->all();
    }


}
