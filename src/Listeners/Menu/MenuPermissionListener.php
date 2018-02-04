<?php

namespace Alpaca\Listeners\Menu;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class MenuPermissionListener
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
            'title' => 'Menu',
            'slug' => 'menu',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Administer menus',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create menu',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit menu',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete menu',
                'slug' => 'delete',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Add link',
                'slug' => 'add_link',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit link',
                'slug' => 'edit_link',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete link',
                'slug' => 'delete_link',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
