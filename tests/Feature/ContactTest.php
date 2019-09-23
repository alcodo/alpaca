<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Illuminate\Support\Facades\Mail;
use Alpaca\Mail\ContactFormWasFilled;

class ContactTest extends IntegrationTest
{
    public function test_show_contact_page()
    {
        $this->get(config('alpaca.contact.path'))
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

        $this->post(config('alpaca.contact.path'), [
            'name' => 'John Doe',
            'subject' => 'Welcome',
            'text' => 'Hi Alpaca User',
            'form_time' => 'honeypot',
            'g-recaptcha-response' => 'ALPACA-TEST',
        ])
            ->assertRedirect('/contact');

        Mail::assertSent(ContactFormWasFilled::class, function (ContactFormWasFilled $mail) {
            $to = config('mail.from');

            return $mail->hasTo($to['address']);
        });
    }
}
