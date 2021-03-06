<?php

namespace Tests\Feature\User;

use Alpaca\Models\Role;
use Tests\IntegrationTest;
use Alpaca\Models\Permission;

class MigrationTest extends IntegrationTest
{
    public function testPermission()
    {
        $this->withoutExceptionHandling();

        $this->assertEquals(3, Role::count());
        $this->assertEquals(39, Permission::count());

        $adminRole = Role::whereSlug('administrator')->first();
        $this->assertEquals(39, $adminRole->permissions->count());

        $permission = Permission::first();
        $this->assertEquals(1, $permission->roles->count());
    }

    public function testUserIsAdmin()
    {
        $adminRole = Role::whereSlug('administrator')->first();
        $this->assertEquals(1, $adminRole->users->count());
    }
}
