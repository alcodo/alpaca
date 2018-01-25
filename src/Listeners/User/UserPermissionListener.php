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
                'name' => 'Administer user',
                'slug' => 'administer_user',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create user',
                'slug' => 'create_user',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit user',
                'slug' => 'edit_user',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete user',
                'slug' => 'delete_user',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
