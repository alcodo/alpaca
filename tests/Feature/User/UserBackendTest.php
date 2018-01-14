<?php

namespace Tests\Feature;

use Alpaca\Events\User\UserWasCreated;
use Alpaca\Events\User\UserWasDeleted;
use Alpaca\Events\User\UserWasUpdated;
use Alpaca\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Tests\Feature\User\Helper\PermissionModuleSetAndTearUp;

class UserBackendTest extends PermissionModuleSetAndTearUp
{

    public function test_index_user()
    {
        $this->withoutExceptionHandling();

        $this->get('/backend/user')
            ->assertSuccessful()
            ->assertSee('Add user');
    }

    public function test_store_user()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->post('/backend/user', [
            'name' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ])
            ->assertRedirect('/backend/user');

        $this->assertDatabaseHas('users', [
            'name' => 'JohnDoe',
        ]);

        Event::assertDispatched(UserWasCreated::class);
    }

    public function test_update_user()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->createUser();

        $this->put('/backend/user/1', [
            'name' => 'Max'
        ])
            ->assertRedirect('/backend/user');


        $this->assertDatabaseHas('users', [
            'name' => 'Max',
        ]);

        Event::assertDispatched(UserWasUpdated::class);
    }

    public function test_destroy_block()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->createUser();
        $this->assertDatabaseHas('users', [
            'name' => 'JohnDoe',
        ]);

        $this->delete('/backend/user/1')
            ->assertRedirect('/backend/user');


        $this->assertDatabaseMissing('users', [
            'name' => 'JohnDoe',
        ]);

        Event::assertDispatched(UserWasDeleted::class);
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

}