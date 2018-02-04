<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class UserPermissionListener
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
            'title' => 'User',
            'slug' => 'user',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Administer users',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create user',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit user',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete user',
                'slug' => 'delete',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
