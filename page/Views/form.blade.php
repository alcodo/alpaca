@extends('app')

@section('content')
    @if(Route::currentRouteName() === 'page.create')
        <h1>{{ trans('helper::bundle.create_type', ['type' => trans('page::page.page')]) }}</h1>
    @else
        <h1>{{ trans('helper::bundle.edit_type', ['type' => trans('page::page.page')]) }}</h1>
    @endif

    <hr/>

    @if(Route::currentRouteName() === 'page.create')
        {!! Form::open(['url' => route('page.store')]) !!}
    @else
        {!! Form::model($page, ['method' => 'PATCH', 'url' => route('page.update', $page->id)]) !!}
    @endif

    <div class="form-group">
        {!! Form::label('title', trans('helper::bundle.title')) !!}
        {!! Form::text('title', $page->title, ['required', 'class' => 'form-control is-title']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('slug', trans('helper::bundle.path')) !!}
        {!! Form::text('slug', $page->slug, ['class' => 'form-control is-path']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category', trans('page::category.category')) !!}
        {!! Form::select('category', $categories, $page->category_id, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', trans('helper::bundle.text')) !!}
        {!! Form::textarea('body', $page->text, ['class' => 'form-control is-summernote']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('html_title', trans('page::page.html_title')) !!}
        {!! Form::text('html_title', $page->html_title, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('meta_description', trans('page::page.meta_description')) !!}
        {!! Form::textarea('meta_description', $page->meta_description, ['class' => 'form-control', 'rows' => 4, 'maxlength' => 200]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('meta_robots', trans('page::page.meta_robots')) !!}
        {!! Form::select('meta_robots', ['index' => 'index,follow','noindex' => 'noindex,nofollow'], $page->meta_robots) !!}
    </div>

    <div class="form-group">
        {!! Form::label('visibility', trans('page::page.visibility')) !!}
        {!! Form::select('visibility', [
            '1' => trans('page::page.visibility_all'),
            '0' => trans('page::page.visibility_onlyadmins')
        ], $page->active, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit(trans('helper::bundle.save'), ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@endsection
