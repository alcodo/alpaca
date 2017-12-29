@extends('app')

@section('content')
    <h1>{{ trans('contact::contact.contact') }}</h1>

    {!! BootForm::openHorizontal(['sm' => [4, 8],'lg' => [2, 10]])
                    ->action( route('contact.send') ) !!}
    {!! Honeypot::generate('form_name', 'form_time')  !!}
    {!! BootForm::text(trans('contact::contact.name'), 'name') !!}
    {!! BootForm::email(trans('contact::contact.email'), 'email') !!}
    {!! BootForm::text(trans('contact::contact.subject'), 'subject') !!}
    {!! BootForm::textarea(trans('contact::contact.message'), 'text') !!}
    {!! BootForm::submit(trans('contact::contact.send'))->addClass('btn-primary') !!}
    {!! BootForm::close() !!}

@endsection
