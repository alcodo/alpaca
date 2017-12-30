@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::page.edit_page') }}</h1>

    <form action="/backend/page/{{ $page->id }}" method="post" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        @include('alpaca::page.sub.form')
    </form>

@endsection