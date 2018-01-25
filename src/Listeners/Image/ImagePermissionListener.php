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
                'name' => 'Administer image',
                'slug' => 'administer_image',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Create image',
                'slug' => 'create_image',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Edit image',
                'slug' => 'edit_image',
                'description' => '',
            ]),
            new Permission([
                'name' => 'Delete image',
                'slug' => 'delete_image',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
