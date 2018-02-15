<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\User;
use Illuminate\Auth\Events\Registered;
use Alpaca\Notifications\VerifyAccount;
use Alpaca\Exceptions\UserStartVerificationProcess;
use Illuminate\Support\Facades\Notification;

class StartVerificationProcess
{

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {

        /** @var User $user */
        $user = $event->user;

        // generate token
        // TODO

        // send mail
        Notification::send($user, new VerifyAccount($user->verification_token, $user->name));

        // output
        throw new UserStartVerificationProcess();

    }
}
