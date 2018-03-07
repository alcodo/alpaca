@extends('alpaca::layout')

@section('content')

    @can('page.create')
    <a href="/backend/page/create" class="btn btn-info float-right">
        {{ trans('alpaca::page.create_page') }}
    </a>
    @endcan


    <h1>
        {{ trans('alpaca::page.page_index') }}
    </h1>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.title') }}</th>
            <th>{{ trans('alpaca::alpaca.active') }}</th>
            <th>{{ trans('alpaca::category.category') }}</th>
            <th>{{ trans('alpaca::alpaca.user') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>
                    <a href="{{ $page->path }}">{{ $page->title }}</a>
                </td>
                <td>
                    @if($page->active)
                        <i class="fas fa-check text-success" aria-hidden="true"></i>
                    @else
                        <i class="fas fa-times text-danger" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    @if($page->category)
                        <a href="{{ $page->category->path }}">{{ $page->category->title }}</a>
                    @endif
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