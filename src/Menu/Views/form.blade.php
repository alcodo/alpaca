@extends('app')

@section('content')
    @if(Route::currentRouteName() === 'menu.create')
        <h1>{{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.menu')]) }}</h1>
    @else
        <h1>{{ trans('helper::bundle.edit_type', ['type' => trans('menu::menu.menu')]) }}</h1>
    @endif

    <hr/>

    @if(Route::currentRouteName() === 'menu.create')
        {!! Form::open(['url' => route('menu.store')]) !!}
    @else
        {!! Form::model($menu, ['method' => 'PATCH', 'url' => route('menu.update', $menu->id)]) !!}
    @endif

    <div class="form-group">
        {!! Form::label('name', trans('helper::bundle.name')) !!}
        {!! Form::text('name', null, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit(trans('helper::bundle.save'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection