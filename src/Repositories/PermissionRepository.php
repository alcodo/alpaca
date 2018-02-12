<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasSaved;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Models\Permission;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Validator;

class PermissionRepository
{
    public function findOrCreate(array $data): Permission
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if (empty($data['slug'])) {
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        return Permission::firstOrCreate($data);
    }

    public function create(array $data): Permission
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if (empty($data['slug'])) {
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $permission = Permission::create($data);
        event(new PermissionWasCreated($permission));

        return $permission;
    }

    public function update(Permission $permission, array $data): Permission
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if (empty($data['slug'])) {
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $permission->update($data);
        event(new PermissionWasUpdated($permission));

        return $permission;
    }

    public function delete(Permission $permission): bool
    {
        $permission->delete();
        event(new PermissionWasDeleted($permission));

        return true;
    }

    public function attachPermissionsToRole($role, $syncPermissions)
    {
        $ids = collect($syncPermissions)->pluck('id')->all();

        // sync with role
        $role->permissions()->sync($ids);

        event(new PermissionWasSaved());
    }
}