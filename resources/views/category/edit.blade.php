@extends('alpaca::layout')

@section('content')

    <h1>{{ trans('alpaca::category.edit_category') }}</h1>

    <form action="/backend/category/{{ $category->id }}" method="post" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        @include('alpaca::category.sub.form')
    </form>

@endsection