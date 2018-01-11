<?php

namespace Tests\Feature;

use Alpaca\Events\User\UserWasCreated;
use Alpaca\Events\User\UserWasDeleted;
use Alpaca\Events\User\UserWasUpdated;
use Alpaca\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class UserBackendTest extends IntegrationTest
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
//            'title' => 'Frontblock',
//            'area' => 'left',
//            'active' => true,
//            'position' => 0,
//            'exception_rule' => true,
        ])
            ->assertRedirect('/backend/user');

        $this->assertDatabaseHas('al_users', [
//            'title' => 'Frontblock',
        ]);

        Event::assertDispatched(UserWasCreated::class);
    }

    public function test_update_user()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->createUser();

        $this->put('/backend/user/1', [
//            'title' => 'Crazy block',
//            'area' => 'right',
//            'active' => false,
//            'position' => 1,
//            'exception_rule' => false,
        ])
            ->assertRedirect('/backend/user');

        $this->assertDatabaseHas('al_users', [
//            'title' => 'Crazy block',
        ]);

        Event::assertDispatched(UserWasUpdated::class);
    }

    public function test_destroy_block()
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $this->createBlock();

        $this->assertDatabaseHas('al_users', [
//            'title' => 'Test',
        ]);

        $this->delete('/backend/user/1')
            ->assertRedirect('/backend/user');

        $this->assertDatabaseMissing('al_users', [
//            'title' => 'Test',
        ]);

        Event::assertDispatched(UserWasDeleted::class);
    }

    private function createUser()
    {
        $repo = new UserRepository();
        $repo->create([
            'title' => 'Test',
            'area' => 'left',
            'active' => true,
            'position' => 0,
            'exception_rule' => true,
        ]);
    }

}