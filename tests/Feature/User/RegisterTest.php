<?php

namespace Tests\Feature;

use Alpaca\Models\User;
use Tests\IntegrationTest;
use Illuminate\Support\Facades\Event;

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
            'email' => 'john_doe@notFakeMailAdress.com',
            'password' => 'mySecretPassword',
            'password_confirmation' => 'mySecretPassword',
            'g-recaptcha-response' => 'ALPACA-TEST',
        ])
            ->assertRedirect('/home');

        $this->assertAuthenticated();

        Event::assertDispatched(\Illuminate\Auth\Events\Registered::class);
    }
}
