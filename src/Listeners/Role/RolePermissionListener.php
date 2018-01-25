<?php

namespace Alpaca\Listeners\Role;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class RolePermissionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return array
     */
    public function handle()
    {
        $module = new PermissionModule([
            'title' => 'Role',
            'slug' => 'role',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Administer role',
                'slug' => 'administer_role',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create role',
                'slug' => 'create_role',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit role',
                'slug' => 'edit_role',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete role',
                'slug' => 'delete_role',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
