<?php

namespace Alpaca\Listeners\Redirect;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class RedirectPermissionListener
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
            'title' => 'Redirect',
            'slug' => 'redirect',
        ]);

        $module->permissions = [
            new Permission([
                'name' => 'Administer redirects',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create redirect',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit redirect',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete redirect',
                'slug' => 'delete',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
