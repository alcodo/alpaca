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
        $user = $event->user;
//        dd($event->user);

        Mail::send('user::emails.verification', ['user' => $user],
            function ($m) use ($user) {
                $m->to($user->email);
                $subject = trans('user::user.verification').' - '.config('app.name');
                $m->subject($subject);
//            $m->from('noreply@example.com');
//            $m->bcc('notifications@example.com');
//            $m->getHeaders()->addTextHeader('X-MailThief-Variables', 'mailthief');
            }
        );

//        Mail::to(
//            $event->user->email
//        )->send(
//            new EmailVerification($event->user)
//        );
    }
}
