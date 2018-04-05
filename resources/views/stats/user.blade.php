@extends('alpaca::layout')

@section('content')


    <div class="mb-3">
        {{ trans('alpaca::alpaca.view') }}:
        <a href="/backend/stats/user?view=day&last={{ request()->get('last') }}" class="btn btn-info">
            {{ trans('alpaca::alpaca.day') }}
        </a>
        <a href="/backend/stats/user?view=month&last={{ request()->get('last') }}" class="btn btn-info">
            {{ trans('alpaca::alpaca.month') }}
        </a>


        <div class="float-right">
            {{ trans('alpaca::alpaca.last') }}:
            <a href="/backend/stats/user?view={{ request()->get('view') }}&last=3" class="btn btn-secondary">
                3 {{ trans('alpaca::alpaca.months') }}
            </a>
            <a href="/backend/stats/user?view={{ request()->get('view') }}&last=6" class="btn btn-secondary">
                6 {{ trans('alpaca::alpaca.months') }}
            </a>
            <a href="/backend/stats/user?view={{ request()->get('view') }}&last=12" class="btn btn-secondary">
                12 {{ trans('alpaca::alpaca.months') }}
            </a>
        </div>
    </div>

    <h1>
        {{ trans('alpaca::user.registrated_user') }} - {{ trans('alpaca::alpaca.stats') }}
    </h1>

    <line-chart :data="{
        labels: {{ json_encode(array_keys($stats)) }},
        datasets: [
            {
                label: '{{ trans('alpaca::user.registrated_user') }}',
                backgroundColor: '#f87979',
                data: {{ json_encode(array_values($stats)) }}
            }
        ]}" :options="{responsive: true, maintainAspectRatio: false}"></line-chart>

    <div class="row">
        <div class="col-3">
            Sum: {{ $sum }}
        </div>
        <div class="col-3">
            Avg: {{ $avg }}
        </div>
        <div class="col-3">
            Min: {{ $min }}
        </div>
        <div class="col-3">
            Max: {{ $max }}
        </div>
    </div>

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