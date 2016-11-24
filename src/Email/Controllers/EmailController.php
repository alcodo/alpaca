<?php

namespace Alpaca\Email\Controllers;

use Alpaca\Core\Controllers\Controller;

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

        return view('email::list');
    }

    public function register()
    {
        return view('contact::form');
    }

    public function passwort_reset()
    {
        return view('contact::form');
    }
}
