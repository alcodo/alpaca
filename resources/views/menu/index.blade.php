@extends('alpaca::layout')

@section('content')

    <a href="/backend/menu/create" class="btn btn-info float-right">
        {{ trans('alpaca::menu.create_menu') }}
    </a>
    <h1>
        {{ trans('alpaca::menu.menu_index') }}
    </h1>

    @foreach($menus as $menu)
        {{ dump($menu) }}
    @endforeach

{{--    @include('alpaca::page.sub.action', ['isIndex' => false, 'isShow' => true])--}}

@endsection