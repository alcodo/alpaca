@extends('app')

@section('content')
    <div class="pull-right">

        {!! editButton(route('menu.edit', [$menu->id]))  !!}
        {!! deleteForm(route('menu.destroy', [$menu->id])) !!}
    </div>

    <h1 class="page-header">{{$menu->name}}</h1>

    <a class="btn btn-primary pull-right" href="{{route('menu.item.create', [$menu->slug])}}">
        {{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.create_menu_item')]) }}
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
        @foreach ($menu->items as $index => $item)
            <tr>
                <td>@include('menu::item.link', $item)</td>
                <td>{{ $item->updated_at }}</td>
                <td>{{ $item->created_at }}</td>
                <td class="pull-right">
                    {!! editButton(route('menu.item.edit', [$menu->slug, $item->id]), trans('menu::menu.edit_item'))  !!}
                    {!! deleteForm(route('menu.item.destroy', [$menu->slug, $item->id]), trans('menu::menu.delete_item'))  !!}
                </td>
            </tr>
        @endforeach
    </table>

    <a class="btn btn-primary pull-right" href="{{route('menu.item.create', [$menu->slug])}}">
        {{ trans('helper::bundle.create_type', ['type' => trans('menu::menu.create_menu_item')]) }}
    </a>
@endsection