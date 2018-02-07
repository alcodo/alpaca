<?php

namespace Tests\Feature;

use Tests\IntegrationTest;

class EmailTemplateTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    /**
     * @test
     */
    public function it_allow_see_index()
    {
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

        $this->get('/backend/email-template/passwort_reset')
            ->assertSee(trans('alpaca::user.reset_password'));
    }
}
