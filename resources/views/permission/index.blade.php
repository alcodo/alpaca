@extends('alpaca::layout')

@section('content')

    {{--create--}}
    {{--<a href="#" class="btn btn-info float-right" v-b-modal.modalcreatepermission>--}}
    {{--{{ trans('alpaca::user.add_permission') }}--}}
    {{--</a>--}}
    {{--@include('alpaca::permission.sub.create')--}}


    <h1>
        {{ trans('alpaca::user.permissions') }}
    </h1>

    <div class="row">

        @foreach($permissions as $module)

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card" style="border: 1px solid silver;">
                    <div class="card-header">
                        {{ $module->title }}
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($module->permissions as $perm)

                            <li class="list-group-item">

                                <div class="media">
                                    <label class="media-body " for="{{ $module->slug }}.{{ $perm->name }}">
                                        {{ $perm->name }}
                                    </label>
                                    <div class="ml-4 form-check">
                                        <input class="form-check-input" type="checkbox"
                                               name="{{ $module->slug }}.{{ $perm->name }}"
                                               id="{{ $module->slug }}.{{ $perm->name }}">
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        @endforeach

    </div>

    {{--<div class="row">--}}

    {{--@foreach($permissions as $module)--}}

    {{--<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">--}}
    {{--<div class="card" style="border: 1px solid silver;">--}}
    {{--<div class="card-header">--}}
    {{--{{ $module->title }}--}}
    {{--</div>--}}
    {{--<ul class="list-group list-group-flush">--}}
    {{--@foreach($module->permissions as $perm)--}}
    {{--<li class="list-group-item">--}}
    {{--{{ $perm->name }}--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--@endforeach--}}

    {{--</div>--}}

    {{--<table class="table">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>{{ trans('alpaca::alpaca.name') }}</th>--}}
    {{--<th>{{ trans('alpaca::alpaca.created') }}</th>--}}
    {{--<th>{{ trans('alpaca::alpaca.updated') }}</th>--}}
    {{--<th></th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($permissions as $permission)--}}
    {{--<tr>--}}
    {{--<td>--}}
    {{--{{ $permission->id }}: {{ $permission->name }}--}}
    {{--</td>--}}
    {{--<td>{{ dateintl_full('short', $permission->created_at) }}</td>--}}
    {{--<td>{{ dateintl_full('short', $permission->updated_at) }}</td>--}}
    {{--<td>--}}
    {{--@include('alpaca::permission.sub.action', ['isIndex' => false, 'isShow' => true])--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}


@endsection