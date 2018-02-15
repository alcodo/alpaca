<?php

namespace Tests\Feature;

use Alpaca\Events\User\UserWasCreated;
use Alpaca\Events\User\UserWasDeleted;
use Alpaca\Events\User\UserWasUpdated;
use Alpaca\Repositories\UserRepository;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class UserBackendTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

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
        $this->assertEquals(1, User::count());

        $this->delete('/backend/user/1')
            ->assertRedirect('/backend/user');

        $this->assertEquals(0, User::count());
        Event::assertDispatched(UserWasDeleted::class);
    }

    public function test_assign_role()
    {
        // TODO
        
        $repo = new UserRepository();
        $repo->syncRole('guest', User::first());

        $roles = User::first()->roles;
        $this->assertCount(2, $roles);
        $this->assertEquals('guest', $roles->where('slug', 'guest')->first()->slug);
    }

    protected function createUser()
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