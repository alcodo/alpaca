@extends('alpaca::layout')

@section('content')

    {{--create--}}
    @can('user.create')
        <a href="#" class="btn btn-info float-right" v-b-modal.modalcreateuser>
            {{ trans('alpaca::user.add_user') }}
        </a>
        @include('alpaca::user.sub.create')
    @endcan


    <h1>
        {{ trans('alpaca::user.users') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.title') }}</th>
            <th>{{ trans('alpaca::user.roles') }}</th>
            <th>{{ trans('alpaca::user.confirm') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->id }}: {{ $user->name }}
                    <br>
                    {{ $user->email }}
                </td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge badge-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    @if($user->verified)
                        <i class="fas fa-check text-success" aria-hidden="true"></i>
                    @else
                        <i class="fas fa-times text-danger" aria-hidden="true"></i>
                    @endif
                </td>
                <td>{{ dateintl_full('short', $user->created_at) }}</td>
                <td>{{ dateintl_full('short', $user->updated_at) }}</td>
                <td>
                    @include('alpaca::user.sub.action', ['user' => $user, 'isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

@endsection