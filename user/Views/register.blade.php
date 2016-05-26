@extends('app')

@section('content')

    <h1>{{ trans('user::user.register') }}</h1>

    {!! Form::open(['url' => action('Alcodo\User\Controllers\AuthController@postRegister'), 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('username', trans('user::user.username'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('username', null, ['required', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', trans('user::user.email'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', null, ['required', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', trans('user::user.password'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['required', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', trans('user::user.password_confirm'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password_confirmation', ['required', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit(trans('user::user.register'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection