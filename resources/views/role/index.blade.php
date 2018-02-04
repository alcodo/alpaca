@extends('alpaca::layout')

@section('content')

    {{--create--}}
    @can('role.create')
        <a href="#" class="btn btn-info float-right" v-b-modal.modalcreaterole>
            {{ trans('alpaca::user.add_role') }}
        </a>
        @include('alpaca::role.sub.create')
    @endcan



    <h1>
        {{ trans('alpaca::user.roles') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.name') }}</th>
            <th>{{ trans('alpaca::user.permissions') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>
                    {{ $role->name }}
                </td>
                <td>{{ $role->permissions->count() }}</td>
                <td>{{ dateintl_full('short', $role->created_at) }}</td>
                <td>{{ dateintl_full('short', $role->updated_at) }}</td>
                <td>
                    @include('alpaca::role.sub.action', ['isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection