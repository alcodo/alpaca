@extends('app')

@section('content')
    <h1>{{ trans('user::user.edit_user') }}</h1>
    {!! Form::model($user, ['method' => 'PATCH', 'url' => action('Alcodo\User\Controllers\UserController@update', $user->_id)]) !!}

    <div class="form-group">
        {!! Form::label('name', trans('user::user.name')) !!}
        {!! Form::email('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-Mail') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role', 'Status:') !!}
        {!! Form::select('role', [
        '0' => 'Admin',
        '1' => 'Salon'
        ], $user->role) !!}
    </div>

    <div class="form-group">
        {!! Form::submit(trans('user::user.save'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection