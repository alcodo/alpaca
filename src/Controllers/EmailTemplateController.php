<?php

namespace Alpaca\Controllers;

use Alpaca\Notifications\User\ResetPassword;
use Alpaca\Notifications\User\VerifyAccount;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class EmailTemplateController extends Controller
{
    public function index()
    {
        if (!View::exists('vendor.notifications.email')) {
            Flash::error(trans('alpaca::emailtemplate.template_file_not_exists'));
        }

        $emailTemplates = [
            [
                'text' => trans('user::user.register'),
                'link' => '/backend/email-template/register',
            ],
            [
                'text' => trans('user::user.reset_password'),
                'link' => '/backend/email-template/passwort_reset',
            ],
        ];

        return view('alpaca::emailtemplate.list', compact('emailTemplates'));
    }

    public function show($template)
    {
        if (!View::exists('vendor.notifications.email')) {
            throw new \Exception(trans('alpaca::emailtemplate.template_file_not_exists'));
        }

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

        $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));
        return $markdown->render('vendor.notifications.email', $message->toArray());
    }
}
