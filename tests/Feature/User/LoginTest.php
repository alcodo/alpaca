<?php

namespace Tests\Feature;

use Alpaca\Models\User;
use Tests\IntegrationTest;
use Illuminate\Support\Facades\Event;
use Alpaca\Repositories\UserRepository;

class LoginTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->makeAuth();
    }

    public function testShowLoginPage()
    {
        $this->withoutExceptionHandling();

        $this->get('/login')
            ->assertSuccessful()
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Remember Me')
            ->assertSee('Forgot Your Password?');
    }

    public function testLoginWithAlpacaUser()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->assertGuest();

        $this->post('/login', [
            'email' => 'admin@alpaca.com',
            'password' => 'alpaca',
        ])
            ->assertRedirect('/home');

        $this->assertAuthenticated();
        $this->assertAuthenticatedAs(User::first());

        // TODO events not working ?
//        Event::assertDispatched(\Illuminate\Auth\Events\Attempting::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Authenticated::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Login::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Failed::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Logout::class);
    }

    public function testLogout()
    {
        $this->loginAsAdmin();
        $this->assertAuthenticatedAs(User::first());

        $this->post('/logout');
        $this->assertGuest();
    }

    public function testUserNotAllowedToLogin()
    {
        Event::fake();
//        $this->withoutExceptionHandling();
//        $this->expectException(\Alpaca\Exceptions\UserIsNotVerified::class);

        // register a user
        $user = $this->createUser();

        // prepare
        /* @var \Alpaca\Models\User $user */
        $this->assertFalse(User::find($user->id)->verified);
        $this->assertGuest();

        // login
        $this->post('/login', [
            'email' => 'john@example.com',
            'password' => '123456',
        ])
            ->assertRedirect('/');
//            ->assertSee('You are not verified. Please verifier your account first.');

        $this->assertGuest();

        // TODO events are not working
//        Event::assertDispatched(\Alpaca\Listeners\User\IsUserVerified::class);
    }

    protected function createUser()
    {
        $repo = new UserRepository();

        return $repo->create([
            'name' => 'JohnDoe',
            'email' => 'john@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);
    }
}
