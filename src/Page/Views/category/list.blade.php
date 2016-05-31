@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('page::category.category') }}</h1>

            <a class="btn btn-primary pull-right"
               href="{{route('category.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('page::category.category')]) }}
            </a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-4">{{ trans('helper::bundle.name') }}</th>
                    <th class="col-md-3">{{ trans('helper::bundle.slug') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.created') }}</th>
                    <th class="col-md-1">{{ trans('helper::bundle.updated') }}</th>
                    <th class="col-md-5"></th>
                </tr>
                </thead>
                @foreach ($entries as $i => $entry)
                    <tr>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->slug }}</td>
                        <td>{{ $entry->created_at }}</td>
                        <td>{{ $entry->updated_at }}</td>
                        <td class="pull-right">
                            @if ($entry->active == 0)
                                <span class="label label-warning">{{ trans('helper::bundle.private') }}</span>
                            @endif
                            {!! showButton(route('category.show', [$entry->slug]))  !!}
                            {!! editButton(route('category.edit', [$entry->id]))  !!}
                            {!! deleteForm(route('category.destroy', [$entry->id]))  !!}
                        </td>
                    </tr>
                @endforeach
            </table>

            <a class="btn btn-primary pull-right"
               href="{{route('category.create')}}">
                {{ trans('helper::bundle.create_type', ['type' => trans('page::category.category')]) }}
            </a>

        </div>
    </div>
@endsection