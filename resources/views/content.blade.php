@if(isset($withContainerBody) && $withContainerBody === false)

    {{--without container bodt--}}
    @include('alpaca::partials.error')
    @include('alpaca::partials.message')
    @yield('content')

@else

    {{--with--}}
    <div class="card mb-3">
        <div class="card-body">
            @include('alpaca::partials.error')
            @include('alpaca::partials.message')
            @yield('content')
        </div>
    </div>

@endif