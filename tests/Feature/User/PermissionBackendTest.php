<?php

namespace Tests\Feature\User;

use Tests\IntegrationTest;
use Illuminate\Support\Facades\Event;
use Alpaca\Repositories\PermissionRepository;
use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasUpdated;

class PermissionBackendTest extends IntegrationTest
{
    /**
     * @var PermissionRepository
     */
    protected $repo;

    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
        $this->repo = new PermissionRepository();
    }

    public function test_index_permission()
    {
        $this->withoutExceptionHandling();

        $this->get('/backend/permission')
            ->assertSuccessful();
    }

    public function test_store_permission()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->repo->create([
            'name' => 'Hogwords',
        ]);

        $this->assertDatabaseHas('permissions', [
            'name' => 'Hogwords',
        ]);

        Event::assertDispatched(PermissionWasCreated::class);
    }

    public function test_update_permission()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $permission = $this->createPermission();

        $this->repo->update($permission, [
            'name' => 'Delete article',
        ]);

        $this->assertDatabaseHas('permissions', [
            'name' => 'Delete article',
        ]);
        Event::assertDispatched(PermissionWasUpdated::class);
    }

    public function test_destroy_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $permission = $this->createPermission();

        $this->repo->delete($permission);

        $this->assertDatabaseMissing('permissions', [
            'name' => 'Edit article',
        ]);
        Event::assertDispatched(PermissionWasDeleted::class);
    }

    protected function createPermission()
    {
        return $this->repo->create(['name' => 'Edit article']);
    }
}
