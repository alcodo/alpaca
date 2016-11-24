<?php

namespace Alpaca\Email\Controllers;

use Alpaca\Core\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function index()
    {
        $emailTemplates = [
            [
                'text' => trans('user::user.register'),
                'link' => '/backend/email/register',
            ],
            [
                'text' => trans('user::user.reset_password'),
                'link' => '/backend/email/passwort_reset',
            ],
        ];

        return view('email::list', compact('emailTemplates'));
    }

    public function register()
    {
        $mail = new \Illuminate\Auth\Notifications\VerifyAccount('SECRET_TOKEN', 'JOHNdoe');
        return $this->generateNotification($mail);
    }

    public function passwort_reset()
    {
        $mail = new \Illuminate\Auth\Notifications\ResetPassword('SECRET_TOKEN');
        return $this->generateNotification($mail);
    }

    /**
     * @param $mail
     * @return mixed
     */
    protected function generateNotification($mail)
    {
        $message = $mail->toMail(null);

        $template = $message->view[0];
        $data = $message->toArray();

        return view($template, $data);
    }
}
