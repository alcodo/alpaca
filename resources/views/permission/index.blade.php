@extends('alpaca::layout')

@section('content')

    <h1>
        {{ trans('alpaca::user.permissions') }}
    </h1>


    <b-tabs>

        @foreach($roles as $role)

            <b-tab title="{{ $role->name }}">

                <form action="/backend/permission" method="post">

                    {{ csrf_field() }}
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <input type="hidden" name="role_name" value="{{ $role->name }}">

                    <br>
                    @include('alpaca::permission.card')


                    <button type="submit" class="btn btn-info btn-block">
                        {{ $role->name }} {{ strtolower(trans('alpaca::alpaca.save')) }}
                    </button>

                </form>

            </b-tab>

        @endforeach
    </b-tabs>

@endsection