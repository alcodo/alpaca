<?php

class WebTest extends TestCase
{
    /**
     * @test
     */
    public function it_allow_see_index()
    {
        $this->visit('/backend/email');
    }

    /**
     * @test
     */
    public function it_allow_see_email_register()
    {
        $this->visit('/backend/email/register');
    }

    /**
     * @test
     */
    public function it_allow_see_email_password_reset()
    {
        $this->visit('/backend/email/passwort_reset');
    }
}
