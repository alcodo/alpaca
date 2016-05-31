@if(!is_null(Block::createBlock('top')))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::createBlock('top') !!}
        </div>
    </div>
@endif

<div class="row">
    @if(!is_null(Block::createBlock('left')) && !is_null(Block::createBlock('right')))

        <aside class="col-sm-3">
            {!! Block::createBlock('left') !!}
        </aside>
        <main class="col-sm-6">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-3">
            {!! Block::createBlock('right') !!}
        </aside>

    @elseif(!is_null(Block::createBlock('left')))
        <aside class="col-sm-3">
            {!! Block::createBlock('left') !!}
        </aside>

        <main class="col-sm-9">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
    @elseif(!is_null(Block::createBlock('right')))
        <main class="col-sm-9">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
        <aside class="col-sm-3">
            {!! Block::createBlock('right') !!}
        </aside>
    @else
        <main class="col-sm-12">
            <div class="area-content">
                @yield('content')
            </div>
        </main>
    @endif

</div>

@if(!is_null(Block::createBlock('bottom')))
    <div class="row">
        <div class="col-sm-12">
            {!! Block::createBlock('bottom') !!}
        </div>
    </div>
@endif