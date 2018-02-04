<?php

namespace Alpaca\Listeners\Category;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class CategoryPermissionListener
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
            'title' => 'Category',
            'slug' => 'category',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Administer categories',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create category',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit category',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete category',
                'slug' => 'delete',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
