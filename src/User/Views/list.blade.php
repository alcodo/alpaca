@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ trans('user::user.user') }}</h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-3">{{ trans('user::user.name') }}</th>
                    <th class="col-md-3">E-Mail</th>
                    <th class="col-md-2">{{ trans('user::user.created') }}</th>
                    <th class="col-md-2">{{ trans('user::user.updated') }}</th>
                    <th class="col-md-1"></th>
                    <th class="col-md-1"></th>
                    <th class="col-md-1"></th>
                </tr>
                </thead>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{action('\Alpaca\User\Controllers\UserController@show', [$user->name])}}">
                                {{ trans('user::user.show') }}
                            </a>
                        </td>
                        <td>
                            {{--<a class="btn btn-info" href="{{action('\Alpaca\User\Controllers\UserController@edit', [$user->name])}}">--}}
                                {{--{{ trans('user::user.edit') }}--}}
                            {{--</a>--}}
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'url' => action('\Alpaca\User\Controllers\UserController@destroy', $user->id)])
                            !!}

                            <button data-toggle="confirmation" data-placement="bottom"
                                    data-btnOkLabel="{{ trans('page::page.yes') }}"
                                    data-btnCancelLabel="{{ trans('page::page.cancel') }}"
                                    data-title="{{ trans('page::page.remove-sure') }}"
                                    type="submit" class="btn btn-danger">{{ trans('page::page.remove') }}
                            </button>

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection