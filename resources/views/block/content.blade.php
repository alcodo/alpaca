@if(Block::existsBlocks('top'))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::getBlocks('top') !!}
        </div>
    </div>
@endif

<div class="row">
    @if(Block::existsBlocks('left') && Block::existsBlocks('right'))

        <aside class="col-sm-3">
            {!! Block::getBlocks('left') !!}
        </aside>
        <main class="col-sm-6">
            <div class="area-content">
                {!! Block::getBlocks('content-top') !!}
                @yield('content')
                {!! Block::getBlocks('content-bottom') !!}
            </div>
        </main>
        <aside class="col-sm-3">
            {!! Block::getBlocks('right') !!}
        </aside>

    @elseif(Block::existsBlocks('left'))

        <aside class="col-sm-3">
            {!! Block::getBlocks('left') !!}
        </aside>

        <main class="col-sm-9">
            <div class="area-content">
                {!! Block::getBlocks('content-top') !!}
                @yield('content')
                {!! Block::getBlocks('content-bottom') !!}
            </div>
        </main>

    @elseif(Block::existsBlocks('right'))

        <main class="col-sm-9">
            <div class="area-content">
                {!! Block::getBlocks('content-top') !!}
                @yield('content')
                {!! Block::getBlocks('content-bottom') !!}
            </div>
        </main>
        <aside class="col-sm-3">
            {!! Block::getBlocks('right') !!}
        </aside>

    @else

        <main class="col-sm-12">
            <div class="area-content">
                {!! Block::getBlocks('content-top') !!}
                @yield('content')
                {!! Block::getBlocks('content-bottom') !!}
            </div>
        </main>

    @endif

</div>

@if(Block::existsBlocks('bottom'))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::getBlocks('bottom') !!}
        </div>
    </div>
@endif