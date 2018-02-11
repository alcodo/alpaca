<?php

namespace Alpaca\Support;

use Alpaca\Models\Role;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Auth\Authenticatable;

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

            // user has registered role
            if (is_null($user->roles)) {
                return $this->hasPermission('registered' . '.' . $permissionSlug);
            }

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
        if ($this->cache->has($this->cacheKey)) {

            $this->cache->forget($this->cacheKey);
            $this->getPermissionFromCache();

        }
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

        $allPermissions = $roles->map(function ($role) {

            // get all permissions
            return $role->permissions
                ->map(function ($perm) use ($role) {
                    return $role->slug . '.' . $perm->slug;
                })
                ->all();

        })
            ->collapse()
            ->all();

        return $allPermissions;
    }


}
