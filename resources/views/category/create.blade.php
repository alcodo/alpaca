@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::category.create_category') }}</h1>

    <form action="/backend/category" method="post" accept-charset="UTF-8">
        @include('alpaca::category.sub.form')
    </form>

@endsection