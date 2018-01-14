@extends('alpaca::layout')

@section('content')

    {{--create--}}
    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreateuser>
        {{ trans('alpaca::user.add_permission') }}
    </a>
    @include('alpaca::user.sub.create')


    <h1>
        {{ trans('alpaca::user.users') }}
    </h1>

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('alpaca::alpaca.title') }}</th>
            <th>{{ trans('alpaca::user.roles') }}</th>
            <th>{{ trans('alpaca::alpaca.active') }}</th>
            <th>{{ trans('alpaca::alpaca.created') }}</th>
            <th>{{ trans('alpaca::alpaca.updated') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($users as $user)--}}
                    {{--{{ dump($user) }}--}}
            {{--<tr>--}}
                {{--<td>--}}
                    {{--{{ $user->id }}: {{ $user->name }}--}}
                    {{--<br>--}}
                    {{--{{ $user->email }}--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--@if($page->active)--}}
                        {{--<i class="fa fa-check text-success" aria-hidden="true"></i>--}}
                    {{--@else--}}
                        {{--<i class="fa fa-times text-danger" aria-hidden="true"></i>--}}
                    {{--@endif--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--@if($page->category)--}}
                        {{--<a href="{{ $page->category->path }}">{{ $page->category->title }}</a>--}}
                    {{--@endif--}}
                {{--</td>--}}
                {{--<td>{{ $page->user_id }}</td>--}}
                {{--<td>{{ dateintl_full('short', $user->created_at) }}</td>--}}
                {{--<td>{{ dateintl_full('short', $user->updated_at) }}</td>--}}
                {{--<td>--}}
                    {{--@include('alpaca::user.sub.action', ['isIndex' => false, 'isShow' => true])--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        </tbody>
    </table>

@endsection