<?php

namespace Alpaca\Listeners\Image;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class ImagePermissionListener
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
            'title' => 'Image',
            'slug' => 'image',
        ]);

        $module->permissions = [
            new Permission([
                'name' => 'Administer images',
                'slug' => 'administer',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create image',
                'slug' => 'create',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit image',
                'slug' => 'edit',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete image',
                'slug' => 'delete',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
