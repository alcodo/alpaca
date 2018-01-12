<?php

namespace Tests\Feature;

use Alpaca\Mail\ContactFormWasFilled;
use Illuminate\Support\Facades\Mail;
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
        Mail::fake();
        $this->withoutExceptionHandling();
        Honeypot::disable();

        $this->post('/contact', [
            'name' => 'John Doe',
            'subject' => 'Welcome',
            'text' => 'Hi Alpaca User',
            'form_time' => 'honeypot',
        ])
            ->assertRedirect('/contact');

        Mail::assertSent(ContactFormWasFilled::class, function (ContactFormWasFilled $mail) {
            $to = config('mail.from');
            return $mail->hasTo($to['address']);
        });
    }
}
