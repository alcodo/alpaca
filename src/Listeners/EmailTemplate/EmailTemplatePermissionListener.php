<?php

namespace Alpaca\Listeners\EmailTemplate;

use Alpaca\Models\Permission;
use Alpaca\Models\PermissionModule;

class EmailTemplatePermissionListener
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
            'title' => 'Email Template',
            'slug' => 'emailtemplate',
        ]);


        $module->permissions = [
            new Permission([
                'name' => 'Show template',
                'slug' => 'show_template',
                'description' => '',
            ]),
        ];

        return $module;
    }
}
