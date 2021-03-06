<?php

namespace Alpaca\Listeners\Permission;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class PermissionPermissionListener
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
            'title' => 'Permission',
            'slug' => 'permission',
        ]);

        $module->permissions = [
            new Permission([
                'name' => 'Administer permissions',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit permission',
                'slug' => 'edit',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
