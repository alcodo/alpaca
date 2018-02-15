<?php

namespace Tests\Feature;

use Alpaca\Models\User;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

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

//        Event::assertDispatched(\Illuminate\Auth\Events\Attempting::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Authenticated::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Login::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Failed::class);
//        Event::assertDispatched(\Illuminate\Auth\Events\Logout::class);
    }

}