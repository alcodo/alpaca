@extends('alpaca::layout')

@section('content')

    @include('alpaca::menu.sub.modal')

    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreatemenu>
        {{ trans('alpaca::menu.create_menu') }}
    </a>
    <h1>
        {{ trans('alpaca::menu.menu_index') }}
    </h1>

    <div class="row">
        @foreach($menus as $menu)
            {{--<div class="col">--}}


            <div class="col-sm-6">
                <div class="card" style="border: 1px solid silver">
                    <div class="card-header">
                        {{ $menu->title }}

                        @include('alpaca::menu.sub.action')
                    </div>
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item" href="/backend/page">Page</a>
                        <a class="list-group-item" href="/backend/category">Category</a>
                        <a class="list-group-item" href="/backend/menu">Menu</a>
                        <a class="list-group-item" href="/contact">Contact</a>
                        <a class="list-group-item" href="/backend/email-template">E-Mail Templates</a>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>

            {{--{{ dump($menu) }}--}}
            {{--</div>--}}
        @endforeach
    </div>


    {{--    @include('alpaca::page.sub.action', ['isIndex' => false, 'isShow' => true])--}}

@endsection