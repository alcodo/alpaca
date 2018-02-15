<?php

namespace Tests\Feature;

use Alpaca\Listeners\User\SendVerificationEmail;
use Alpaca\Models\User;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class RegisterTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->makeAuth();
    }

    public function testShowRegisterPage()
    {
        $this->withoutExceptionHandling();

        $this->get('/register')
            ->assertSuccessful()
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Confirm Password')
            ->assertSee('Register');
    }

    public function testRegister()
    {
        Event::fake();
        $this->withoutExceptionHandling();

        $this->assertGuest();
        $this->equalTo(1, User::count());

        $this->post('/register', [
            'name' => 'JohnDoe',
            'email' => 'john_doe@example.com',
            'password' => 'mySecretPassword',
            'password_confirmation' => 'mySecretPassword',
        ])
//            ->assertRedirect('/');
            ->assertRedirect('/home');

//        $this->assertGuest();
//        $this->assertAuthenticated();
//        $this->equalTo(2, User::count());

        Event::assertDispatched(\Illuminate\Auth\Events\Registered::class);
//        Event::assertDispatched(SendVerificationEmail::class);
    }

}