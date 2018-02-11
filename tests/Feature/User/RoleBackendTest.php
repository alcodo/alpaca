<?php

namespace Tests\Feature\User;

use Alpaca\Events\Role\RoleWasCreated;
use Alpaca\Events\Role\RoleWasDeleted;
use Alpaca\Events\Role\RoleWasUpdated;
use Alpaca\Models\Role;
use Alpaca\Repositories\RoleRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class RoleBackendTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_index_role()
    {
        $this->withoutExceptionHandling();

        $this->get('/backend/role')
            ->assertSuccessful()
            ->assertSee('Add role');
    }

    public function test_store_role()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->post('/backend/role', [
            'name' => 'Hogwords',
        ])
            ->assertRedirect('/backend/role');

        $this->assertDatabaseHas('roles', [
            'name' => 'Hogwords',
        ]);
        Event::assertDispatched(RoleWasCreated::class);
    }

    public function test_update_role()
    {
        Event::fake();

        $this->withoutExceptionHandling();

        $this->createRole();

        $this->put('/backend/role/1', [
            'name' => 'Alpha tester',
        ])
            ->assertRedirect('/backend/role');


        $this->assertDatabaseHas('roles', [
            'name' => 'Alpha tester',
        ]);
        Event::assertDispatched(RoleWasUpdated::class);
    }

    public function test_destroy_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createRole();
        $this->assertEquals(4, Role::count());

        $this->delete('/backend/role/1')
            ->assertRedirect('/backend/role');

        $this->assertEquals(3, Role::count());
        Event::assertDispatched(RoleWasDeleted::class);
    }

    protected function createRole()
    {
        $repo = new RoleRepository();
        return $repo->create(['name' => 'Beta tester']);
    }

}