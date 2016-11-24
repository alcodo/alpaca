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
        $user = Auth::user();
        return view('user::emails.verification', compact('user'));
    }

    public function passwort_reset()
    {
        $mail = new \Illuminate\Auth\Notifications\ResetPassword('SECRET_TOKEN');
        $message = $mail->toMail(null);

        $template = $message->view[0];
        $data = $message->toArray();

        return view($template, $data);
    }
}
