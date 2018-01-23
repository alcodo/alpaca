@extends('alpaca::layout')

@section('content')

    <h1>
        {{ trans('alpaca::user.permissions') }}
    </h1>


    <b-tabs>

        @foreach($roles as $role)

            <b-tab title="{{ $role->name }}">

                <br>
                @include('alpaca::permission.card')

            </b-tab>

        @endforeach
    </b-tabs>

@endsection