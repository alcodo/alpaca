@extends('alpaca::layout')

@section('content')

    {{--create--}}
    @can('redirect.create')
        <a href="#" class="btn btn-info float-right" v-b-modal.modalcreateredirect>
            {{ trans('alpaca::redirect.create_redirect') }}
        </a>
        @include('alpaca::redirect.sub.create')
    @endcan

    <h1>
        {{ trans('alpaca::redirect.redirects') }}
    </h1>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ trans('alpaca::alpaca.name') }}</th>
            <th>{{ trans('alpaca::redirect.from') }}</th>
            <th>{{ trans('alpaca::redirect.to') }}</th>
            <th>{{ trans('alpaca::redirect.code') }}</th>
            <th>{{ trans('alpaca::redirect.hits') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($redirects as $redirect)
            <tr>
                <td>
                    {{ $redirect->id }}
                </td>
                <td>
                    {{ $redirect->from }}
                </td>
                <td>
                    {{ $redirect->to }}
                </td>
                <td>
                    {{ $redirect->code }}
                </td>
                <td>
                    {{ $redirect->hits }}
                </td>
                <td>{{ dateintl_full('short', $redirect->created_at) }}</td>
                <td>{{ dateintl_full('short', $redirect->updated_at) }}</td>
                <td>
                    @include('alpaca::redirect.sub.action', ['isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection