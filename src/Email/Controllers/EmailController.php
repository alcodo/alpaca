<?php

namespace Alpaca\Email\Controllers;

use Alpaca\Core\Controllers\Controller;
use Alpaca\User\Notifications\ResetPassword;
use Alpaca\User\Notifications\VerifyAccount;

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

    public function show($template)
    {
        switch ($template) {
            case 'register':

                $mail = new VerifyAccount('SECRET_TOKEN', 'USERNAME');
                return $this->generateNotification($mail);

            case 'passwort_reset':

                $mail = new ResetPassword('SECRET_TOKEN');
                return $this->generateNotification($mail);
        }
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
