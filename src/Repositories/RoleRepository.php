<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Role\RoleWasCreated;
use Alpaca\Events\Role\RoleWasDeleted;
use Alpaca\Events\Role\RoleWasUpdated;
use Alpaca\Models\Role;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Validator;

class RoleRepository
{

    public function create(array $data): Role
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if (empty($data['slug'])) {
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $role = Role::create($data);
        event(new RoleWasCreated($role));

        return $role;
    }

    public function update(Role $role, array $data): Role
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if (empty($data['slug'])) {
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $role->update($data);
        event(new RoleWasUpdated($role));

        return $role;
    }

    public function delete(Role $role): bool
    {
        $role->delete();
        event(new RoleWasDeleted($role));

        return true;
    }

    public function syncRole($roleSlug, $user): void
    {
        $role = Role::whereSlug($roleSlug)->first();
        if (is_null($role)) {
            throw new \Exception('role not found: ' . $roleSlug);
        }

        $role->users()->sync($user);
    }

    public function syncRoleByIds($user, array $roleIds): void
    {
        $user->roles()->sync($roleIds);
    }

}