@if(BlockDesktop::existsBlocks('top'))
    <div class="row">
        <div class="col-sm-12">
            {!! BlockDesktop::getBlocks('top') !!}
        </div>
    </div>
@endif

<div class="row">
    @if(BlockDesktop::existsBlocks('left') && BlockDesktop::existsBlocks('right'))

        <aside class="col-sm-3">
            {!! BlockDesktop::getBlocks('left') !!}
        </aside>
        <main class="col-sm-6">
            <div class="area-content">
                {!! BlockDesktop::getBlocks('content-top') !!}
                @yield('content')
                {!! BlockDesktop::getBlocks('content-bottom') !!}
            </div>
        </main>
        <aside class="col-sm-3">
            {!! BlockDesktop::getBlocks('right') !!}
        </aside>

    @elseif(BlockDesktop::existsBlocks('left'))

        <aside class="col-sm-3">
            {!! BlockDesktop::getBlocks('left') !!}
        </aside>

        <main class="col-sm-9">
            <div class="area-content">
                {!! BlockDesktop::getBlocks('content-top') !!}
                @yield('content')
                {!! BlockDesktop::getBlocks('content-bottom') !!}
            </div>
        </main>

    @elseif(BlockDesktop::existsBlocks('right'))

        <main class="col-sm-9">
            <div class="area-content">
                {!! BlockDesktop::getBlocks('content-top') !!}
                @yield('content')
                {!! BlockDesktop::getBlocks('content-bottom') !!}
            </div>
        </main>
        <aside class="col-sm-3">
            {!! BlockDesktop::getBlocks('right') !!}
        </aside>

    @else

        <main class="col-sm-12">
            <div class="area-content">
                {!! BlockDesktop::getBlocks('content-top') !!}
                @yield('content')
                {!! BlockDesktop::getBlocks('content-bottom') !!}
            </div>
        </main>

    @endif

</div>

@if(BlockDesktop::existsBlocks('bottom'))
    <div class="row">
        <div class="col-sm-12">
            {!! BlockDesktop::getBlocks('bottom') !!}
        </div>
    </div>
@endif