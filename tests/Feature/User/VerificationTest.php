<?php

use Alpaca\Listeners\User\IsUserVerified;
use Alpaca\Models\User;
use Alpaca\Repositories\UserRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class VerificationTest extends IntegrationTest
{
    /**
     * @test
     */
//    public function it_allow_to_verificaiton_after_registration()
//    {
//        // remove all users
//        User::truncate();
//        $this->assertNull(User::first());
//
//        // register a user
//        Honeypot::disable();
//        $formUser = $this->registerUser();
//        $this->assertTrue(Auth::guest(), 'User is logged in');
//
//        // check database
//        $user = User::first();
//        $this->assertEquals('0', $user->verified);
//        $this->assertNotEmpty($user->email_token);
//
//        // check mail
//        $this->assertTrue(MailThief::hasMessageFor($user->email));
//        $this->assertEquals('Verification - My Application', MailThief::lastMessage()->subject);
//
//        $emailContent = MailThief::lastMessage()->getBody();
//        $this->assertTrue(strpos($emailContent, $user->email_token) !== false);
//
//        // verify
//        $this->visit('/register/verify/' . $user->email_token)
//            ->see('alert-success');
//
//        // check db
//        $this->assertEquals('1', User::first()->verified);
//        $this->assertEquals(null, User::first()->email_token);
//
//        // login
//        $this->visit('/login')
//            ->type($formUser->email, 'email')
//            ->type($formUser->password, 'password')
//            ->press(trans('user::user.login'))
//            ->see('alert-success');
//        $this->assertFalse(Auth::guest(), 'User is NOT logged in');
//    }

    public function testUserNotAllowedToLogin()
    {
        $this->withoutExceptionHandling();
        $this->expectException(\Alpaca\Exceptions\UserIsNotVerified::class);
        Event::fake();
        Honeypot::disable();

        // register a user
        $user = $this->createUser();

        // prepare
        /** @var \Alpaca\Models\User $user */
        $this->assertFalse(User::find($user->id)->verified);
        $this->assertGuest();

        // login
        $this->post('/login', [
            'email' => 'john@example.com',
            'password' => '123456',
        ])
            ->assertRedirect()
            ->assertSee('You are not verified. Please verifie your account first.');

        $this->assertGuest();
        Event::assertDispatched(\Alpaca\Listeners\User\IsUserVerified::class);
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
