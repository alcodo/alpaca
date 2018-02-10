<?php

namespace Alpaca\Repositories;

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

        if(empty($data['slug'])){
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

        if(empty($data['slug'])){
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $permission = Permission::create($data);

        return $permission;
    }

    public function update(Permission $permission, array $data): Permission
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'slug' => 'string|max:255',
        ])->validate();

        if(empty($data['slug'])){
            $data['slug'] = SlugifyFacade::slugify($data['name']);
        }

        $permission->update($data);

        return $permission;
    }

    public function delete(Permission $permission): bool
    {
        $permission->delete();

        return true;
    }

}