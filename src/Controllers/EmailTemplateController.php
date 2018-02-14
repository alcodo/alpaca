<?php

namespace Alpaca\Controllers;

use Alpaca\Notifications\ResetPassword;
use Alpaca\Notifications\VerifyAccount;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class EmailTemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:emailtemplate.show_template');
    }

    public function index()
    {
        if (!View::exists('vendor.notifications.email')) {
            Flash::error(trans('alpaca::emailtemplate.template_file_not_exists'));
        }

        $emailTemplates = [
            [
                'text' => trans('alpaca::user.register'),
                'link' => '/backend/email-template/register',
            ],
            [
                'text' => trans('alpaca::user.reset_password'),
                'link' => '/backend/email-template/passwort_reset',
            ],
        ];

        return view('alpaca::emailtemplate.index', compact('emailTemplates'));
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
