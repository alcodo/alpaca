<?php

namespace Alpaca\Listeners\Contact;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class ContactPermissionListener
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
            'title' => 'Contact',
            'slug' => 'contact',
        ]);

        $module->permissions = [
            new Permission([
                'name' => 'Send',
                'slug' => 'send',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
