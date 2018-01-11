<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Alpaca\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Notification;

class AccountVerification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  FooEvent $event
     * @return void
     */
    public function handle(Registered $event)
    {
        /** @var User $user */
        $user = $event->user;

        Notification::send($user, new VerifyAccount($user->email_token, $user->username));
    }
}
