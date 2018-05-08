@if(isset($withBlockWrapper) && $withBlockWrapper === false)

    @include('alpaca::content')

@else

    @if(Block::existsBlocks('top'))
        <div class="row">
            <div class="col-12">
                {!! Block::getBlocks('top') !!}
            </div>
        </div>
    @endif

    <div class="row">
        @if(Block::existsBlocks('left') && Block::existsBlocks('right'))

            <aside class="col-12 col-md-4 col-xl-3 order-2 order-sm-2 order-md-1">
                {!! Block::getBlocks('left') !!}
            </aside>
            <main class="col-12 col-md-8 col-xl-6 order-1 order-sm-1 order-md-2">
                <div class="area-content">
                    {!! Block::getBlocks('content-top') !!}

                    @include('alpaca::content')

                    {!! Block::getBlocks('content-bottom') !!}
                </div>
            </main>
            <aside class="col-12 col-md-4 col-xl-3 order-3 order-sm-3  order-md-2">
                {!! Block::getBlocks('right') !!}
            </aside>

        @elseif(Block::existsBlocks('left'))

            <aside class="col-12 col-md-4 col-xl-3 order-2 order-sm-2 order-md-1">
                {!! Block::getBlocks('left') !!}
            </aside>

            <main class="col-12 col-md-8 col-xl-9 order-1 order-sm-1 order-md-2">
                <div class="area-content">
                    {!! Block::getBlocks('content-top') !!}

                    @include('alpaca::content')

                    {!! Block::getBlocks('content-bottom') !!}
                </div>
            </main>

        @elseif(Block::existsBlocks('right'))

            <main class="col-12 col-md-8 col-xl-9">
                <div class="area-content">
                    {!! Block::getBlocks('content-top') !!}

                    @include('alpaca::content')

                    {!! Block::getBlocks('content-bottom') !!}
                </div>
            </main>
            <aside class="col-12 col-md-4 col-xl-3">
                {!! Block::getBlocks('right') !!}
            </aside>

        @else

            <main class="col-12">
                <div class="area-content">
                    {!! Block::getBlocks('content-top') !!}

                    @include('alpaca::content')

                    {!! Block::getBlocks('content-bottom') !!}
                </div>
            </main>

        @endif

    </div>

    @if(Block::existsBlocks('bottom'))
        <div class="row">
            <div class="col-12">
                {!! Block::getBlocks('bottom') !!}
            </div>
        </div>
    @endif

@endif