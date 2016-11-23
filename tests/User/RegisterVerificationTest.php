<?php

use Alpaca\User\Models\User;
use MailThief\Facades\MailThief;

class RegisterVerificationTest extends TestCase
{
    /**
     * @test
     */
    public function it_send_a_email_after_registration()
    {
        MailThief::hijack();

        // remove all users
        User::truncate();
        $this->assertNull(User::first());

        // register a user
        Honeypot::disable();
        $this->registerUser();

        // check database
        $user = User::first();
        $this->assertEquals('0', $user->verified);
        $this->assertNotEmpty($user->email_token);

        // check mail
        $this->assertTrue(MailThief::hasMessageFor($user->email));
        $this->assertEquals('Verification - My Application', MailThief::lastMessage()->subject);

        $emailContent = MailThief::lastMessage()->getBody();
        $this->assertTrue(strpos($emailContent, $user->email_token) !== false);
    }

    protected function registerUser()
    {
        $user = factory(User::class, 'form')->make();

        $this->visit('/register')
            ->see('Register')
            ->type($user->username, 'username')
            ->type($user->email, 'email')
            ->type($user->password, 'password')
            ->type($user->password, 'password_confirmation')
            ->press(trans('user::user.register'))
            ->see('alert-success');
    }

}
