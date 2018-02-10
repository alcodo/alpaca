<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Role;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Validator;

class RoleRepository
{

    public function create(array $data): Role
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['name']);

        $role = Role::create($data);

        return $role;
    }

    public function update(Role $role, array $data): Role
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['name']);

        $role->update($data);

        return $role;
    }

    public function delete(Role $role): bool
    {
        $role->delete();

        return true;
    }

}