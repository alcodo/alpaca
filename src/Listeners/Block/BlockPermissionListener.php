<?php

namespace Alpaca\Listeners\Block;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class BlockPermissionListener
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
            'title' => 'Block',
            'slug' => 'block',
        ]);

        $module->permissions = [
            new Permission([
                'name' => 'Administer blocks',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create block',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit block',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete block',
                'slug' => 'delete',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
