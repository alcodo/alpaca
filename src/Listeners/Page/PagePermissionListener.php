<?php

namespace Alpaca\Listeners\Page;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class PagePermissionListener
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
            'title' => 'Page',
            'slug' => 'page',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Administer pages',
                'slug' => 'administer_pages',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create page',
                'slug' => 'create_page',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit page',
                'slug' => 'edit_page',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete page',
                'slug' => 'delete_page',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
