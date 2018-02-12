@extends('alpaca::layout')

@section('content')

    <h1>
        {{ trans('alpaca::user.permissions') }}
    </h1>


    <b-tabs v-cloak>

        @foreach($roles as $role)

            <b-tab title="{{ $role->name }}" class="mt-3">

                @can('permission.edit')
                    <form action="/backend/permission" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                        <input type="hidden" name="role_name" value="{{ $role->name }}">
                        @endcan

                        @include('alpaca::permission.card')

                        @can('permission.edit')
                            <button type="submit" class="btn btn-info btn-block">
                                {{ $role->name }} {{ strtolower(trans('alpaca::alpaca.save')) }}
                            </button>

                    </form>
                @endcan

            </b-tab>

        @endforeach
    </b-tabs>

@endsection