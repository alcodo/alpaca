<?php

use Alpaca\User\Models\User;

class EmailTest extends TestCase
{
    /**
     * @test
     */
    public function it_allow_see_index()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $this->visit('/backend/email')
            ->see(trans('user::user.register'))
            ->see(trans('user::user.reset_password'));
    }

    /**
     * @test
     */
    public function it_allow_see_email_register()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $this->visit('/backend/email/register')
            ->see(trans('user::user.register'));
    }

    /**
     * @test
     */
    public function it_allow_see_email_password_reset()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $this->visit('/backend/email/passwort_reset')
            ->see(trans('user::user.reset_password'));
    }
}
