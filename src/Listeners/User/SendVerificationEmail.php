<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\User;
use Illuminate\Auth\Events\Registered;
use Alpaca\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Notification;

class SendVerificationEmail
{

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        dd(444);
        /** @var User $user */
        $user = $event->user;

        Notification::send($user, new VerifyAccount($user->email_token, $user->username));

        dd(1);
    }
}
