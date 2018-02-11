@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::block.edit_block') }}</h1>

    <form action="/backend/block/{{ $block->id }}" method="post" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        @include('alpaca::block.sub.form')
    </form>

@endsection