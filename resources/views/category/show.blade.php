@extends('alpaca::layout')

@section('content')

    <div class="float-right">
        @include('alpaca::category.sub.action', ['isIndex' => true, 'isShow' => false])
    </div>

    <h1>{{ $category->title }}</h1>
    {!!$category->content !!}

    @foreach ($category->pages as $index => $page)
        @include('alpaca::category.sub.page')
    @endforeach
@endsection