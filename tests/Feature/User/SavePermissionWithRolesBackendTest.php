<?php

namespace Tests\Feature\User;

use Alpaca\Models\Role;
use Tests\IntegrationTest;
use Alpaca\Models\Permission;
use Illuminate\Support\Facades\Event;
use Alpaca\Repositories\PermissionRepository;
use Alpaca\Events\Permission\PermissionWasSaved;

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
            ],
        ])
            ->assertRedirect('/backend/permission');

        $this->assertEquals(2, $role->permissions()->count());

        Event::assertDispatched(PermissionWasSaved::class);
    }
}
