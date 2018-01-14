<?php

namespace Alpaca\Repositories;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public function create(array $data): Permission
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
        ])->validate();

        $permission = Permission::create($data);

        return $permission;
    }

    public function update(Permission $permission, array $data): Permission
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
        ])->validate();

        $permission->update($data);

        return $permission;
    }

    public function delete(Permission $permission): bool
    {
        $permission->delete();

        return true;
    }

}