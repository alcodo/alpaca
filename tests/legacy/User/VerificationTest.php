<?php

use Alpaca\User\Models\User;
use MailThief\Facades\MailThief;
use Illuminate\Support\Facades\Auth;

class VerificationTest extends TestCase
{
    /**
     * @test
     */
    public function it_allow_to_verificaiton_after_registration()
    {
        MailThief::hijack();

        // remove all users
        User::truncate();
        $this->assertNull(User::first());

        // register a user
        Honeypot::disable();
        $formUser = $this->registerUser();
        $this->assertTrue(Auth::guest(), 'User is logged in');

        // check database
        $user = User::first();
        $this->assertEquals('0', $user->verified);
        $this->assertNotEmpty($user->email_token);

        // check mail
        $this->assertTrue(MailThief::hasMessageFor($user->email));
        $this->assertEquals('Verification - My Application', MailThief::lastMessage()->subject);

        $emailContent = MailThief::lastMessage()->getBody();
        $this->assertTrue(strpos($emailContent, $user->email_token) !== false);

        // verify
        $this->visit('/register/verify/'.$user->email_token)
            ->see('alert-success');

        // check db
        $this->assertEquals('1', User::first()->verified);
        $this->assertEquals(null, User::first()->email_token);

        // login
        $this->visit('/login')
            ->type($formUser->email, 'email')
            ->type($formUser->password, 'password')
            ->press(trans('user::user.login'))
            ->see('alert-success');
        $this->assertFalse(Auth::guest(), 'User is NOT logged in');
    }

    /**
     * @test
     */
    public function it_not_allow_to_login_without_verify()
    {
        // register a user
        Honeypot::disable();
        $formUser = $this->registerUser();

        // login
        $this->visit('/login')
            ->type($formUser->email, 'email')
            ->type($formUser->password, 'password')
            ->press(trans('user::user.login'))
            ->see('alert-danger');

        $this->assertTrue(Auth::guest(), 'User is logged in');
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

        return $user;
    }
}
