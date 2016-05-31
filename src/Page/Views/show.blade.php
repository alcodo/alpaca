@extends('app')

@section('content')
    <h1 class="page-header">{{$page->title}}</h1>
    {!!$page->body !!}

    @if(!is_null($page->category))
        <p>Category: <a href="{{ route('category.show', [$page->category->slug]) }}">{{$page->category->name}}</a></p>
    @endif
@endsection