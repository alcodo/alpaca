<?php

namespace Tests\Feature\User;

use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class PermissionBackendTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_index_permission()
    {
        $this->withoutExceptionHandling();

        $this->get('/backend/permission')
            ->assertSuccessful()
            ->assertSee('Add permission');
    }

    public function test_store_permission()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->post('/backend/permission', [
            'name' => 'Hogwords',
        ])
            ->assertRedirect('/backend/permission');

        $this->assertDatabaseHas('permissions', [
            'name' => 'Hogwords',
        ]);

        Event::assertDispatched(PermissionWasCreated::class);
    }

    public function test_update_permission()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->createPermission();

        $this->put('/backend/permission/1', [
            'name' => 'Delete article'
        ])
            ->assertRedirect('/backend/permission');


        $this->assertDatabaseHas('permissions', [
            'name' => 'Delete article'
        ]);
        Event::assertDispatched(PermissionWasUpdated::class);
    }

    public function test_destroy_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->createPermission();
        $this->assertDatabaseHas('permissions', [
            'name' => 'Edit article',
        ]);

        $this->delete('/backend/permission/1')
            ->assertRedirect('/backend/permission');


        $this->assertDatabaseMissing('permissions', [
            'name' => 'Edit article',
        ]);
        Event::assertDispatched(PermissionWasDeleted::class);
    }

    protected function createPermission()
    {
        $repo = new PermissionRepository();
        return $repo->create(['name' => 'Edit article']);
    }

}