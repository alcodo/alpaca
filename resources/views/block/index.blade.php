@extends('alpaca::layout')

@section('content')

    @can('block.create')
        <a href="/backend/block/create" class="btn btn-info float-right">
            {{ trans('alpaca::block.create_block') }}
        </a>
    @endcan


    <h1>
        {{ trans('alpaca::block.block_index') }}
    </h1>

    <div class="row">
        @foreach($blocks as $block)

            <div class="col-sm-6">

                @include('alpaca::block.generate.block', [
                                                'isWithBorder' => true,
                                                'isWithAction' => true,
                                                ])

            </div>

        @endforeach
    </div>

@endsection