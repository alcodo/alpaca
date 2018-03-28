<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Alpaca\Mail\ContactFormWasFilled;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Config;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     *
     * @return Response
     */
    public function show()
    {
        // Meta
        $title = trans('alpaca::contact.contact');
        SEOMeta::setTitle($title);
        SEOMeta::addMeta('robots', 'noindex, nofollow');
        SEOMeta::addMeta('name', $title, 'itemprop');
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('locale', 'de_DE');

        return view('alpaca::contact.form');
    }

    /**
     * Send email.
     *
     * @return Response
     */
    public function send(Request $request)
    {
        dd(
            $request->all()
        );
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|email',
            'subject' => 'nullable',
            'text' => 'required|string',
            'form_name' => 'honeypot',
            'form_time' => 'required|honeytime:3',
        ])->validate();

        // Send mail
        $input = $request->all();
        Mail::to(config('mail.from.address'))->send(new ContactFormWasFilled($input));

        Flash::success(trans('alpaca::contact.send_successfully'));

        return redirect(config('alpaca.contact.path'));
    }
}
