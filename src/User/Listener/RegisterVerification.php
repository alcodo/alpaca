<?php

namespace Alpaca\User\Listener;

use Alpaca\User\Mail\EmailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegisterVerification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FooEvent $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to(
            $event->user->email
        )->send(
            new EmailVerification($event->user)
        );
    }
}