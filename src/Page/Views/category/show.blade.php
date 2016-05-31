@extends('app')

@section('content')
    <div class="pull-right">
        {!! editButton(route('category.edit', [$entry->id]))  !!}
        {!! deleteForm(route('category.destroy', [$entry->id])) !!}
    </div>

    <h1 class="page-header">{{$entry->name}}</h1>
    {!!$entry->body !!}

    @foreach ($pages as $index => $page)

        <h2>
            <a href="{{ route('page.show', [$page->slug]) }}">{{$page->title}}</a>
        </h2>
        {!!  strstr($page->body, Alcodo\Page\Models\Page::BREAK_TAG, true) !!}

        <p class="clearfix">
            <a class="btn btn-info pull-right clearfix"
               href="{{ route('page.show', [$page->slug]) }}">{{ trans('helper::bundle.read_more') }}
            </a>
        </p>

        <hr/>

    @endforeach
@endsection