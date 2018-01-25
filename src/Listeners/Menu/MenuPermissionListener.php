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
                'name' => 'Administer menu',
                'slug' => 'administer_menu',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create menu',
                'slug' => 'create_menu',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit menu',
                'slug' => 'edit_menu',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete menu',
                'slug' => 'delete_menu',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
