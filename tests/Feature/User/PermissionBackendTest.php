<?php

namespace Tests\Feature\User;

use Spatie\Permission\Models\Permission;
use Tests\Feature\User\Helper\PermissionModuleSetAndTearUp;

class PermissionBackendTest extends PermissionModuleSetAndTearUp
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

    public function test_store_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/backend/permission', [
            'name' => 'Hogwords',
        ])
            ->assertRedirect('/backend/permission');

        $this->assertDatabaseHas('permissions', [
            'name' => 'Hogwords',
        ]);
    }

    public function test_update_permission()
    {
        $this->withoutExceptionHandling();

        $this->createPermission();

        $this->put('/backend/permission/1', [
            'name' => 'Delete article'
        ])
            ->assertRedirect('/backend/permission');


        $this->assertDatabaseHas('permissions', [
            'name' => 'Delete article'
        ]);
    }

    public function test_destroy_block()
    {
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
    }

    protected function createPermission()
    {
        return Permission::create(['name' => 'Edit article']);
    }

}