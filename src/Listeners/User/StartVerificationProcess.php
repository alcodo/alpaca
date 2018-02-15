<?php

namespace Alpaca\Listeners\User;

use Alpaca\Repositories\UserRepository;
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
     * @throws UserStartVerificationProcess
     */
    public function handle(Registered $event)
    {

        /** @var User $user */
        $user = $event->user;

        // generate token
        $repo = new UserRepository();
        $token = $repo->generateVerifyToken($user);

        // send mail
        Notification::send($user, new VerifyAccount($token, $user->name));

        // output
        throw new UserStartVerificationProcess();

    }
}
