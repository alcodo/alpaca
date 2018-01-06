@extends('alpaca::layout')

@section('content')

    <a href="/backend/block/create" class="btn btn-info float-right">
        {{ trans('alpaca::block.create_block') }}
    </a>


    <h1>
        {{ trans('alpaca::block.block_index') }}
    </h1>

    <div class="row">
        @foreach($blocks as $block)

            <div class="col-sm-6">
                <div class="card" style="border: 1px solid silver">

                    <div class="card-header">
                        {{ $block->title }}
                        @include('alpaca::block.sub.action')
                    </div>
                    @if($block->menu)
                        <ul class="list-group list-group-flush">
                            @foreach($block->menu->links as $link)

                                <div class="list-group-item">
                                    @include('alpaca::menu.link.link', ['link' => $link, 'class' => ''])
                                </div>

                            @endforeach
                        </ul>
                    @else
                        <div class="card-body">
                            {!! $block->html !!}
                        </div>
                    @endif
                </div>
            </div>

        @endforeach
    </div>

@endsection