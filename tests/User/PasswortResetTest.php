<?php

use Alpaca\User\Models\User;
use Illuminate\Support\Facades\Auth;
use MailThief\Facades\MailThief;

class PasswortResetTest extends TestCase
{
    /**
     * @test
     */
    public function it_allow_to_verificaiton_after_registration()
    {
        // remove all users
        User::truncate();
        $this->assertNull(User::first());

        // create verified user
        $formUser = factory(User::class, 'form')->make([
            'verified' => 1,
            'password' => bcrypt('passwordOne'),
        ]);
        $formUser->save();
        $this->assertTrue(Auth::guest(), 'User is logged in');

        // send reset link
        MailThief::hijack();

        $this->visit('/password/reset')
            ->type($formUser->email, 'email')
            ->press(trans('user::user.reset_password'))
            ->see('alert-success');
        $password_resets = DB::table('password_resets')->where('email', $formUser->email)->first();
        $this->assertNotNull($password_resets);

        // check mail
        $this->assertTrue(MailThief::hasMessageFor($formUser->email));
        $this->assertEquals('Reset Password', MailThief::lastMessage()->subject);

        $emailContent = MailThief::lastMessage()->getBody();
        $this->assertTrue(strpos($emailContent, $password_resets->token) !== false);

        // click link
        $this->visit('/password/reset/' . $password_resets->token)
            ->see(trans('user::user.reset_password'))
            ->type($formUser->email, 'email')
            ->type('passwordTwo', 'password')
            ->type('passwordTwo', 'password_confirmation')
            ->press(trans('user::user.reset_password'))
            ->see('alert-success');
        $this->assertFalse(Auth::guest(), 'User is NOT logged in');

        // check new password
        $passwordCorrect = app('hash')->check('passwordTwo', User::first()->password);
        $this->assertTrue($passwordCorrect, 'Password not equals with bcrypt');
    }

}
