<?php

/**
 * Simple send form test.
 */
class ContactTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_send_a_contact_message()
    {
        Honeypot::disable();

        $this->visit(route('contact.show'))
            ->type('John Doe', 'name')
            ->type('john@example.com.io', 'email')
            ->type('Contract', 'subject')
            ->type('PHP Interfaces are important.', 'text')
            ->press('Send')
            ->see(trans('contact::contact.send_successfully'));
    }
}