<?php

namespace Alpaca\Repositories;

use Alpaca\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleRepository
{

    public function create(array $data): Role
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
        ])->validate();

//        $data['guard_name'] = str_slug($data['name']);
//        guard_name

        $role = Role::create($data);

        return $role;
    }

    public function update(Role $role, array $data): Role
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
//            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id . ',id',
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