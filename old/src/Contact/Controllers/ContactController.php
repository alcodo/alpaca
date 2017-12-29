<?php

namespace Alpaca\Contact\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Config;
use Alpaca\Core\Controllers\Controller;
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
        $title = trans('contact::contact.contact');
        SEOMeta::setTitle($title);
        SEOMeta::addMeta('robots', 'noindex, nofollow');
        SEOMeta::addMeta('name', $title, 'itemprop');
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('locale', 'de_DE');

        return view('contact::form');
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
            'email' => 'required|email',
            'subject' => 'required',
            'text' => 'required',
            'form_name' => 'honeypot',
            'form_time' => 'required|honeytime:5',
        ]);

        if ($validator->fails()) {
            return redirect(route('contact.show'))
                ->withErrors($validator)
                ->withInput();
        }

        // Send mail
        $input = $request->all();
        Mail::send('contact::email', $input, function ($message) use ($input) {
            $to = Config::get('mail.from');
            $message->to($to['address'], $to['name'])
                ->from($input['email'], $input['name'])
                ->subject($input['subject']);
        });

        Flash::success(trans('contact::contact.send_successfully'));

        return redirect(route('contact.show'));
    }
}
