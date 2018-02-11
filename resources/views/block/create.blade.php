@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::block.create_block') }}</h1>

    <form action="/backend/block" method="post" accept-charset="UTF-8">
        @include('alpaca::block.sub.form')
    </form>

@endsection