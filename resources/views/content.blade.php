<div class="card mb-3">
    <div class="card-body">
        @include('alpaca::partials.error')
        @include('alpaca::partials.message')
        @yield('content')
    </div>
</div>