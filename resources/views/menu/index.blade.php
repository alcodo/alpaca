@extends('alpaca::layout')

@section('content')

    {{--create--}}
    @can('menu.create')
        <a href="#" class="btn btn-info float-right" v-b-modal.modalcreatemenu>
            {{ trans('alpaca::menu.create_menu') }}
        </a>
        @include('alpaca::menu.sub.create')
    @endcan

    <h1>
        {{ trans('alpaca::menu.menu_index') }}
    </h1>

    <div class="row">
        @foreach($menus as $menu)

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        {{ $menu->title }}
                        @include('alpaca::menu.sub.action')
                    </div>

                    {{--links--}}
                    @if($menu->links->isEmpty())
                        <div class="card-body">
                            {{ trans('alpaca::menu.no_links_exists') }}
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($menu->links as $link)

                                <div class="list-group-item">
                                    @include('alpaca::menu.link.link', ['isBlockView' => false, 'link' => $link, 'class' => ''])
                                    @include('alpaca::menu.link.action')
                                </div>

                            @endforeach
                        </ul>
                    @endif
                    <div class="card-footer border-light">

                        @can('menu.add_link')
                            <a href="#" class="btn btn-info btn-sm float-right"
                               title="{{ trans('alpaca::alpaca.link') }}"
                               v-b-modal.modalcreatelink{{ $menu->id }}>
                                <i class="fas fa-plus" aria-hidden="true"></i> {{ trans('alpaca::alpaca.link') }}
                            </a>
                            @include('alpaca::menu.link.create', ['menu' => $menu])
                        @endcan

                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection