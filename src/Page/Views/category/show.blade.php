@extends('app')

@section('content')

    <h1 class="page-header">{{ $category->title }}</h1>
    {!!$category->body !!}

    @foreach ($category->pages as $index => $page)

        <hr/>

        <h2><a href="{{ route('page.show', [$category->slug, $page->slug]) }}">
                {{$page->title}}
            </a></h2>
        @if(strpos($page->body, Alpaca\Page\Models\Page::BREAK_TAG) !== false)
            {{--tag exists--}}
            {!!  strstr($page->body, Alpaca\Page\Models\Page::BREAK_TAG, true) !!}
        @else
            {{--output basic--}}
            {!!  $page->body !!}
        @endif

    @endforeach
@endsection