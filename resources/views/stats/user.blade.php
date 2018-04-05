@extends('alpaca::layout')

@section('content')

    {{--<a href="/backend/stats/user" class="btn btn-info float-right mr-1" v-b-modal.modalcreateuser>--}}
        {{--{{ trans('alpaca::alpaca.stats') }}--}}
    {{--</a>--}}

    <h1>
        {{ trans('alpaca::alpaca.stats') }}
    </h1>

    <p>
        chart... todo
    </p>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.month') }}</th>
            <th>{{ trans('alpaca::alpaca.sum') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($stats as $date => $sum)
            <tr>
                <td>
                    {{ $date }}
                </td>
                <td>
                    {{ $sum }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection