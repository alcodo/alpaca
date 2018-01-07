@extends('alpaca::layout')

@section('content')

    <a href="/backend/image/create" class="btn btn-info float-right">
        {{ trans('alpaca::image.add_image') }}
    </a>


    <h1>
        {{ trans('alpaca::image.images') }}
    </h1>

    {{--<div class="row">--}}
        {{--@foreach($blocks as $block)--}}

            {{--<div class="col-sm-6">--}}

                {{--@include('alpaca::block.show', [--}}
                                                {{--'isWithBorder' => true,--}}
                                                {{--'isWithAction' => true,--}}
                                                {{--])--}}

            {{--</div>--}}

        {{--@endforeach--}}
    {{--</div>--}}

@endsection