@extends('app')

@section('content')

    <h1>{{ trans('page::page.create_page') }}</h1>

    <form action="/backend/page" method="post" accept-charset="UTF-8">
        @include('page::page.form')
    </form>

@endsection