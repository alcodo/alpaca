<?php

namespace Tests\Feature\User;

use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasSaved;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Models\Permission;
use Alpaca\Models\Role;
use Alpaca\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class SavePermissionWithRolesBackendTest extends IntegrationTest
{
    /**
     * @var PermissionRepository
     */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_save()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $role = Role::whereSlug('registered')->first();
        $this->assertEquals(0, $role->permissions->count());

        $this->post('/backend/permission', [
            'role_id' => 2,
            'role_name' => 'Registered user',
            'block' => [
                'administer' => 0,
                'create' => 1,
                'edit' => 1,
                'administer' => 0,
            ]
        ])
            ->assertRedirect('/backend/permission');

        $this->assertEquals(2, $role->permissions()->count());

        Event::assertDispatched(PermissionWasSaved::class);
    }
}