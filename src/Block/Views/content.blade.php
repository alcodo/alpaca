@if(Block::existsBlocks('top'))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::getBlocks('top') !!}
        </div>
    </div>
@endif

<div class="row">
    @if(Block::existsBlocks('left') && Block::existsBlocks('right'))

        <aside class="col-sm-2">
            {!! Block::getBlocks('left') !!}
        </aside>
        <main class="col-sm-8">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-2">
            {!! Block::getBlocks('right') !!}
        </aside>

    @elseif(Block::existsBlocks('left'))

        <aside class="col-sm-2">
            {!! Block::getBlocks('left') !!}
        </aside>

        <main class="col-sm-10">
            <div class="area-content">
                @yield('content')
            </div>
        </main>

    @elseif(Block::existsBlocks('right'))

        <main class="col-sm-10">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-2">
            {!! Block::getBlocks('right') !!}
        </aside>

    @else

        <main class="col-sm-12">
            <div class="area-content">
                @yield('content')
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