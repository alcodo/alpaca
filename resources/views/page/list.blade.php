@extends('alpaca::layout')

@section('content')

    <a href="/backend/page/create" class="btn btn-info float-right">
        {{ trans('alpaca::alpaca.create_page') }}
    </a>
    <h1>
        {{ trans('alpaca::alpaca.pages') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ trans('alpaca::alpaca.title') }}</th>
            <th>{{ trans('alpaca::alpaca.active') }}</th>
            <th>{{ trans('alpaca::alpaca.category') }}</th>
            <th>{{ trans('alpaca::alpaca.user') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>
                    <a target="_blank" href="{{ $page->path }}">{{ $page->title }}</a>
                </td>
                <td>
                    @if($page->active)
                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    <a target="_blank" href="{{ $page->category->path }}">{{ $page->category->title }}</a>
                </td>
                <td>{{ $page->user_id }}</td>
                <td>{{ dateintl_full('short', $page->created_at) }}</td>
                <td>{{ dateintl_full('short', $page->updated_at) }}</td>
                <td>
                    @include('alpaca::page.sub.action', ['isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}

@endsection