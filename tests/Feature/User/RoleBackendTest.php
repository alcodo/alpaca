<?php

namespace Tests\Feature;

use Alpaca\Repositories\UserRepository;
use Spatie\Permission\Models\Role;
use Tests\IntegrationTest;

class RoleBackendTest extends IntegrationTest
{

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--tag' => 'migrations',
        ]);
        $this->loadLaravelMigrations(['--database' => 'testbench']);
    }


    public function tearDown()
    {
        parent::tearDown();

        // delete migration file
        $path = base_path('database/migrations');
        $files = glob($path . '/*_create_permission_tables.php'); // get all file names

        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
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
        $this->assertDatabaseHas('roles', [
            'name' => 'Beta tester',
        ]);

        $this->delete('/backend/role/1')
            ->assertRedirect('/backend/role');


        $this->assertDatabaseMissing('roles', [
            'name' => 'Beta tester',
        ]);
    }

    private function createUser()
    {
        $repo = new UserRepository();
        $repo->create([
            'name' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);
    }

    protected function createRole()
    {
        return Role::create(['name' => 'Beta tester']);
    }

}