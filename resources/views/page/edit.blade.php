@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::alpaca.edit_page') }}</h1>

    <form action="/backend/page/2" method="post" accept-charset="UTF-8">
        @include('alpaca::page.sub.form')
    </form>

@endsection