<?php

use Alpaca\User\Models\User;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_to_register_user()
    {
        Honeypot::disable();

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

    /**
     * @test
     */
    public function it_allows_user_to_login()
    {
        $user = factory(User::class, 'testuser')->create();
        $user->verified();

        // check bcrypt password
        $passwordCorrect = app('hash')->check('testuser', $user->password);
        $this->assertTrue($passwordCorrect, 'Password not equals with bcrypt');

        $this->visit('/login')
            ->see('Login')
            ->type($user->email, 'email')
            ->type('testuser', 'password')
            ->press(trans('user::user.login'))
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_disallow_user_to_login()
    {
        $this->visit('/login')
            ->see('Login')
            ->type('johndoe@example.com', 'email')
            ->type('testuser', 'password')
            ->press(trans('user::user.login'))
            ->see('alert-danger');
    }

    /**
     * @test
     */
    public function it_allows_user_to_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see('Logout');
//            ->click('Logout')
//            ->see('alert-success');
    }

    /*
     * @test
     */
//    public function it_allows_user_to_edit_own_profile()
//    {
        // without user
//        $url = route('user.edit', 'this_user_doesnt_exists');
//        $this->assertEquals(500, $this->call('GET', $url)->getStatusCode(), 'You are not logged in');
//
//        // create user
//        $user = factory(User::class)->create();

        // TODO slug
//        $url = route('user.edit', $user->slug);
//
//        // edit
//        $this->actingAs($user)
//            ->visit($url);
//    }
}
