@extends('app')

@section('content')

    <h1>{{ trans('alpaca::page.create_page') }}</h1>

    <form action="/backend/page" method="post" accept-charset="UTF-8">
        @include('alpaca::page.form')
    </form>

@endsection