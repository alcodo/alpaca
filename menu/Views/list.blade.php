@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('menu::menu.menus') }}</h1>

            <a class="btn btn-primary pull-right" href="{{route('menu.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.menu')]) }}
            </a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-4">{{ trans('helper::bundle.name') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.updated') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.created') }}</th>
                    <th class="col-md-5"></th>
                </tr>
                </thead>
                @foreach ($menus as $index => $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->updated_at }}</td>
                        <td>{{ $menu->created_at }}</td>
                        <td class="pull-right">
                            {!! showButton(route('menu.show', [$menu->slug]))  !!}
                            {!! editButton(route('menu.edit', [$menu->id]))  !!}
                            {!! deleteForm(route('menu.destroy', [$menu->id]))  !!}
                        </td>
                    </tr>
                @endforeach
            </table>

            <a class="btn btn-primary pull-right" href="{{route('menu.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.menu')]) }}
            </a>

        </div>
    </div>
@endsection