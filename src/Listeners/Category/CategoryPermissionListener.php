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
                'name' => 'Create categories',
                'slug' => 'create_categories',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit categories',
                'slug' => 'edit_categories',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete categories',
                'slug' => 'delete_categories',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
