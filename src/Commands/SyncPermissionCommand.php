<?php

namespace Alpaca\Commands;

use Alpaca\Models\Role;
use Illuminate\Console\Command;

class SyncPermissionCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'alpaca:sync_permission';

    /**
     * @var string
     */
    protected $description = 'refresh permissions for admin role';

    /**
     * Publish constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // create all possible permissions
        $permissions = event(new \Alpaca\Events\Permission\PermissionsIsRequested());
        $check = new \Alpaca\Interactions\CheckAllPermissionsExists();
        $allPermissions = $check->handle($permissions);

        // attach all permissions the admin role
        $ids = collect($allPermissions)->pluck('id')->all();
        $adminRole = Role::where('slug', 'administrator')->first();
        $adminRole->permissions()->sync($ids);

    }
}
