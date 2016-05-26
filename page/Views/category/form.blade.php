@extends('app')

@section('content')
    @if(Route::currentRouteName() === 'category.create')
        <h1>{{ trans('helper::bundle.create_type', ['type' => trans('page::category.category')]) }}</h1>
    @else
        <h1>{{ trans('helper::bundle.edit_type', ['type' => trans('page::category.category')]) }}</h1>
    @endif

    <hr/>

    @if(Route::currentRouteName() === 'category.create')
        {!! Form::open(['url' => route('category.store')]) !!}
    @else
        {!! Form::model($entry, ['method' => 'PATCH', 'url' => route('category.update', $entry->id)]) !!}
    @endif

    <div class="form-group">
        {!! Form::label('name', trans('helper::bundle.name')) !!}
        {!! Form::text('name', null, ['required', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('slug', trans('helper::bundle.path')) !!}
        {!! Form::text('slug', null, ['class' => 'form-control is-path']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', trans('helper::bundle.text')) !!}
        {!! Form::textarea('body', null, ['class' => 'form-control is-summernote']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('visibility', trans('page::page.visibility')) !!}
        {!! Form::select('visibility', [
            '1' => trans('page::page.visibility_all'),
            '0' => trans('page::page.visibility_onlyadmins')
        ], null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit(trans('helper::bundle.save'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection