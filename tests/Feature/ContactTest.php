<?php

namespace Tests\Feature;

use Msurguy\Honeypot\HoneypotFacade as Honeypot;
use Tests\IntegrationTest;

class ContactTest extends IntegrationTest
{

    public function test_show_contact_page()
    {
        $this->get('/contact')
            ->assertSuccessful()
            ->assertSee('Contact');
    }

    /**
     * @test
     */
    public function test_it_send_email()
    {
        // TODO check email
        $this->withoutExceptionHandling();
        Honeypot::disable();

        $this->post('/contact', [
            'name' => 'John Doe',
            'subject' => 'Welcome',
            'text' => 'Hi Alpaca User',
        ])
            ->assertRedirect('/contact');

        $to = config('mail.from');

        // TODO

//        $to = Config::get('mail.from');
//        $message->to($to['address'], $to['name'])
//            ->from($input['email'], $input['name'])
//            ->subject($input['subject']);
//
//        $this->assertTrue(MailThief::hasMessageFor('info@example.com'));
//        $this->assertEquals('Contract', MailThief::lastMessage()->subject);
//        $this->assertEquals('john@example.com.io', MailThief::lastMessage()->data['email']);
    }
}
