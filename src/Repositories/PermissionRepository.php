<?php

namespace Alpaca\Repositories;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public function create(array $data): Permission
    {
        dd($data);

        // TODO
//        array:5 [▼
//  "_token" => "uQ8rPNBFTHaJ4k3zKc7ZqqokSkiKH2LGErrnzXms"
//  "role_id" => "9"
//  "role_name" => "Smart People"
//  "category" => array:4 [▼
//    "administer_category" => "0"
//    "create_category" => "1"
//    "edit_category" => "1"
//    "delete_category" => "1"
//  ]
//  "page" => array:4 [▼
//    "administer_pages" => "1"
//    "create_page" => "0"
//    "edit_page" => "0"
//    "delete_page" => "0"
//  ]
//]

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