<?php

namespace Tests\Feature;

use Alpaca\Models\User;
use Tests\IntegrationTest;

class EmailTemplateTest extends IntegrationTest
{
    /**
     * @test
     */
    public function it_allow_see_index()
    {
//        $adminUser = User::first();
//        $this->actingAs($adminUser);

        $this->get('/backend/email-template')
            ->assertSee(trans('alpaca::user.register'))
            ->assertSee(trans('alpaca::user.reset_password'));
    }

    /**
     * @test
     */
    public function it_allow_see_email_register()
    {
        $this->withoutExceptionHandling();

        $this->artisan('vendor:publish', ['--tag' => 'laravel-notifications']);
//        php artisan vendor:publish --tag laravel-notifications

//        $adminUser = User::first();
//        $this->actingAs($adminUser);

        $this->get('/backend/email-template/register')
            ->assertSee(trans('alpaca::user.verify_now'));
    }

    /**
     * @test
     */
    public function it_allow_see_email_password_reset()
    {
        $this->withoutExceptionHandling();

        $this->artisan('vendor:publish', ['--tag' => 'laravel-notifications']);

//        $adminUser = User::first();
//        $this->actingAs($adminUser);

        $this->get('/backend/email-template/passwort_reset')
            ->assertSee(trans('alpaca::user.reset_password'));
    }
}
