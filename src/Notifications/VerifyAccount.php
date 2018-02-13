<?php

namespace Alpaca\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyAccount extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;
    /**
     * @var
     */
    private $username;

    /**
     * VerifyAccount constructor.
     * @param $token
     * @param $username
     */
    public function __construct($token, $username)
    {
        $this->token = $token;
        $this->username = $username;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url('/register/verify', $this->token);

        return (new MailMessage)
            ->success()
            ->subject(trans('alpaca::user.verification').' - '.config('app.name'))
            ->greeting('Hi '.$this->username)
            ->line(trans('alpaca::user.verification_info_last_step', ['type' => config('app.name')]))
            ->action(trans('alpaca::user.verify_now'), $link)
            ->line(trans('alpaca::user.verification_link_advantages', ['type' => config('app.name')]));
    }
}
