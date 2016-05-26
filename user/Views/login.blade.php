@extends('app')

@section('content')

    <h1>{{ trans('user::user.login') }}</h1>

    {!! Form::open(['url' => action('Alcodo\User\Controllers\AuthController@postLogin'), 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('email', trans('user::user.email'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::email('email', null, ['required', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', trans('user::user.password'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('remember') !!} {{ trans('user::user.remember_me') }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit(trans('user::user.login'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection