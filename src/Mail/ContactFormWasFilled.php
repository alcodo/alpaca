<?php

namespace Alpaca\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormWasFilled extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var array
     */
    private $input;

    /**
     * Create a new message instance.
     *
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('alpaca::contact.email')
            ->subject($this->input['subject'])
            ->with($this->input);
    }
}
