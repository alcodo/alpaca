<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|email',
            'subject' => 'nullable',
            'text' => 'required|string',
            'form_name' => 'honeypot',
            'form_time' => 'required|honeytime:3',
        ]);

        if ($validator->fails()) {
            return redirect(route('contact.show'))
                ->withErrors($validator)
                ->withInput();
        }

        // Send mail
        $input = $request->all();
        Mail::send('alpaca::contact.email', $input, function ($message) use ($input) {
            $to = Config::get('mail.from');
            $message->to($to['address'], $to['name'])
                ->from($input['email'], $input['name'])
                ->subject($input['subject']);
        });

        Flash::success(trans('alpaca::contact.send_successfully'));

        return redirect(route('contact.show'));
    }
}
