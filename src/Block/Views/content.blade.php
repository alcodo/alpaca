@if(Block::existsBlock('top'))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::getBlock('top') !!}
        </div>
    </div>
@endif

<div class="row">
    @if(Block::existsBlock('left') && Block::existsBlock('right'))

        <aside class="col-sm-2">
            {!! Block::getBlock('left') !!}
        </aside>
        <main class="col-sm-8">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-2">
            {!! Block::getBlock('right') !!}
        </aside>

    @elseif(Block::existsBlock('left'))

        <aside class="col-sm-2">
            {!! Block::getBlock('left') !!}
        </aside>

        <main class="col-sm-10">
            <div class="area-content">
                @yield('content')
            </div>
        </main>

    @elseif(Block::existsBlock('right'))

        <main class="col-sm-10">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-2">
            {!! Block::getBlock('right') !!}
        </aside>

    @else

        <main class="col-sm-12">
            <div class="area-content">
                @yield('content')
            </div>
        </main>

    @endif

</div>

@if(Block::existsBlock('bottom'))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::getBlock('bottom') !!}
        </div>
    </div>
@endif