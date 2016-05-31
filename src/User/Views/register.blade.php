@extends('app')

@section('content')

    <h1>{{ trans('user::user.register') }}</h1>

    {!! BootForm::openHorizontal([
                              'sm' => [4, 8],
                              'lg' => [2, 10]
    ])->post()->action(action('Alpaca\User\Controllers\AuthController@postRegister')) !!}

    {!! BootForm::text(trans('user::user.username'), 'username')->required() !!}
    {!! BootForm::email(trans('user::user.email'), 'email')->required() !!}
    {!! BootForm::password(trans('user::user.password'), 'password')->required() !!}
    {!! BootForm::password(trans('user::user.password_confirm'), 'password_confirmation')->required() !!}

    {!! BootForm::submit(trans('user::user.register'))->addClass('btn-primary') !!}

    {!! BootForm::close() !!}

@endsection