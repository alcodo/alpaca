@extends('app')

@section('content')

    <h1 class="page-header">{{ $category->title }}</h1>
    {!!$category->body !!}

    @foreach ($pages as $index => $page)

        <h2>
            <a href="{{ route('page.show', [$page->slug]) }}">{{$page->title}}</a>
        </h2>
        {!!  strstr($page->body, Alpaca\Page\Models\Page::BREAK_TAG, true) !!}

        <p class="clearfix">
            <a class="btn btn-info pull-right clearfix"
               href="{{ route('page.show', [$page->slug]) }}">{{ trans('helper::bundle.read_more') }}
            </a>
        </p>

        <hr/>

    @endforeach
@endsection