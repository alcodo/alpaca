<?php

namespace Tests\Feature\User;

use Spatie\Permission\Models\Role;
use Tests\Feature\User\Helper\PermissionModuleSetAndTearUp;

class RoleBackendTest extends PermissionModuleSetAndTearUp
{

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
        $this->assertDatabaseHas('roles', [
            'name' => 'Beta tester',
        ]);

        $this->delete('/backend/role/1')
            ->assertRedirect('/backend/role');


        $this->assertDatabaseMissing('roles', [
            'name' => 'Beta tester',
        ]);
    }

    protected function createRole()
    {
        return Role::create(['name' => 'Beta tester']);
    }

}