@extends('alpaca::layout')

@section('content')

    {{--create--}}
    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreatepermission>
        {{ trans('alpaca::user.add_permission') }}
    </a>
    @include('alpaca::permission.sub.create')


    <h1>
        {{ trans('alpaca::user.permissions') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.name') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>
                    {{ $permission->id }}: {{ $permission->name }}
                </td>
                <td>{{ dateintl_full('short', $permission->created_at) }}</td>
                <td>{{ dateintl_full('short', $permission->updated_at) }}</td>
                <td>
                    @include('alpaca::permission.sub.action', ['isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection