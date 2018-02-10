<?php

namespace Tests\Feature\User;

use Alpaca\Models\Role;
use Alpaca\Repositories\RoleRepository;
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

    public function test_store_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/backend/role', [
            'name' => 'Hogwords',
        ])
            ->assertRedirect('/backend/role');

        $this->assertDatabaseHas('roles', [
            'name' => 'Hogwords',
        ]);
    }

    public function test_update_role()
    {
        $this->withoutExceptionHandling();

        $this->createRole();

        $this->put('/backend/role/1', [
            'name' => 'Alpha tester'
        ])
            ->assertRedirect('/backend/role');


        $this->assertDatabaseHas('roles', [
            'name' => 'Alpha tester'
        ]);
    }

    public function test_destroy_block()
    {
        $this->withoutExceptionHandling();
        $this->createRole();
        $this->assertEquals(4, Role::count());

        $this->delete('/backend/role/1')
            ->assertRedirect('/backend/role');

        $this->assertEquals(3, Role::count());
    }

    protected function createRole()
    {
        $repo = new RoleRepository();
        return $repo->create(['name' => 'Beta tester']);
    }

}