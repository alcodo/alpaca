@extends('app')

@section('content')

    <h1>{{ trans('user::user.login') }}</h1>

    {!! BootForm::openHorizontal([
                                  'sm' => [4, 8],
                                  'lg' => [2, 10]
    ])->post()->action(action('\Alpaca\User\Controllers\AuthController@postLogin')) !!}

    {!! BootForm::text(trans('user::user.email'), 'email')->required() !!}
    {!! BootForm::password(trans('user::user.password'), 'password')->required() !!}
    {!! BootForm::checkbox(trans('user::user.remember_me'), 'remember') !!}
    {!! BootForm::submit(trans('user::user.login'))->addClass('btn-primary') !!}

    {!! BootForm::close() !!}
@endsection