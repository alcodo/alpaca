<?php

namespace Alpaca\Repositories;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleRepository
{

    public function create(array $data): Role
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
        ])->validate();

        $role = Role::create($data);

        return $role;
    }

    public function update(Role $role, array $data): Role
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
        ])->validate();

        $role->update($data);

        return $role;
    }

    public function delete(Role $role): bool
    {
        $role->delete();

        return true;
    }

}