@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('page::page.pages') }}</h1>

            <a class="btn btn-primary pull-right" href="{{route('page.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('page::page.page')]) }}
            </a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-4">{{ trans('helper::bundle.title') }}</th>
                    <th class="col-md-3">{{ trans('helper::bundle.path') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.updated') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.created') }}</th>
                    <th class="col-md-5"></th>
                </tr>
                </thead>
                @foreach ($page as $index => $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td class="pull-right">
                            @if ($post->active == 0)
                                <span class="label label-warning">{{ trans('page::page.private') }}</span>
                            @endif
                            {!! showButton(route('page.show', [$post->slug]))  !!}
                            {!! editButton(route('page.edit', [$post->id]))  !!}
                            {!! deleteForm(route('page.destroy', [$post->id]))  !!}
                        </td>
                    </tr>
                @endforeach
            </table>

            <a class="btn btn-primary pull-right" href="{{route('page.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('page::page.page')]) }}
            </a>

        </div>
    </div>
@endsection