@extends('alpaca::layout')

@section('content')

    <a href="/backend/category/create" class="btn btn-info float-right">
        {{ trans('alpaca::category.create_category') }}
    </a>
    <h1>
        {{ trans('alpaca::category.category_index') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.title') }}</th>
            <th>{{ trans('alpaca::alpaca.active') }}</th>
            <th>{{ trans('alpaca::category.how_pages') }}</th>
            <th>{{ trans('alpaca::alpaca.user') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->title }}
                </td>
                <td>
                    @if($category->active)
                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @endif
                </td>
                <td>
                    {{ $category->pages->count() }}
                </td>
                <td>{{ $category->user_id }}</td>
                <td>{{ dateintl_full('short', $category->created_at) }}</td>
                <td>{{ dateintl_full('short', $category->updated_at) }}</td>
                <td>
                    @include('alpaca::category.sub.action', ['isIndex' => false, 'isShow' => true])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}

@endsection