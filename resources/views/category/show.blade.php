@extends('alpaca::layout')

@section('content')
    <h1>{{ $category->title }}</h1>
    {!!$category->content !!}

    @foreach ($category->pages as $index => $page)
        @include('alpaca::category.page')
    @endforeach
@endsection