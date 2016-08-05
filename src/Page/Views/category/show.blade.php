@extends('app')

@section('content')
    <h1>{{ $category->title }}</h1>
    {!!$category->body !!}

    @foreach ($category->pages as $index => $page)

        <hr/>

        <h2>
            <a href="{{ $page->getPageLink() }}">
                {{$page->title}}
            </a>
        </h2>
        @if(strpos($page->body, Alpaca\Page\Models\Page::BREAK_TAG) !== false)
            {{--tag exists--}}

            {!!  strstr($page->body, Alpaca\Page\Models\Page::BREAK_TAG, true) !!}
            <p class="text-right">

            <a href="{{ $page->getPageLink() }}" class="read-more">{{ trans('page::page.readmore') }}</a>
            </p>

        @else
            {{--output basic--}}
            {!!  $page->body !!}
        @endif

    @endforeach
@endsection