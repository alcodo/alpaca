<?php

namespace Alpaca\Traits;

use Alpaca\Models\Role;

trait Permission
{
    /**
     * Determine if the model has (one of) the given role(s).
     *
     * @param string|array|\Alpaca\Models\Role|\Illuminate\Support\Collection $roles
     *
     * @return bool
     */
    public function hasRole($roles): bool
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = $this->convertPipeToArray($roles);
        }
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }
        if ($roles instanceof Role) {
            return $this->roles->contains('id', $roles->id);
        }
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }

            return false;
        }

        return $roles->intersect($this->roles)->isNotEmpty();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
