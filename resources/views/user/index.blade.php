@extends('alpaca::layout')

@section('content')

    {{--create--}}
    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreateimage>
        {{ trans('alpaca::user.add_user') }}
    </a>
{{--    @include('alpaca::image.sub.create')--}}


    <h1>
        {{ trans('alpaca::user.users') }}
    </h1>

    <div class="row">
        {{--@foreach($users as $image)--}}

            {{--<div class="col-md-4 col-sm-6 col-xs-12">--}}
                {{--@include('alpaca::image.image', ['image' => $image, 'showAction' => true])--}}
            {{--</div>--}}

        {{--@endforeach--}}
    </div>

@endsection