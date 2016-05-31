@extends('app')

@section('content')
    @if(Route::currentRouteName() === 'menu.item.create')
        <h1>{{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.menu')]) }}</h1>
    @else
        <h1>{{ trans('helper::bundle.edit_type', ['type' => trans('menu::menu.menu')]) }}</h1>
    @endif

    <hr/>

    @if(Route::currentRouteName() === 'menu.item.create')
        {!! Form::open(['url' => route('menu.item.store', $slug)]) !!}
    @else
        {!! Form::model($item, ['method' => 'PATCH', 'url' => route('menu.item.update', [$slug, $item->id])]) !!}
    @endif

    <div class="form-group">
        {!! Form::label('text', trans('helper::bundle.text')) !!}
        {!! Form::text('text', null, ['required', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('title', trans('helper::bundle.title')) !!}
        {!! Form::text('title', null, ['required', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('href', trans('helper::bundle.link')) !!}
        {!! Form::text('href', null, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit(trans('helper::bundle.save'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection