<?php

use Alcodo\User\Models\User;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_to_register_user()
    {
        $user = factory(User::class, 'form')->make();
        $url = route('user.register');

        $this->visit($url)
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

        // check bcrypt password
        $passwordCorrect = app('hash')->check('testuser', $user->password);
        $this->assertTrue($passwordCorrect, 'Password not equals with bcrypt');

        $url = route('user.login');

        $this->visit($url)
            ->see('Login')
            ->type($user->email, 'email')
            ->type('testuser', 'password')
            ->press(trans('user::user.login'))
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_allows_user_to_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see('Logout')
            ->click('Logout')
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_allows_user_to_edit_own_profile()
    {
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
    }

}
