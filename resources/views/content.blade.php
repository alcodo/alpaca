<div class="card">
    <div class="card-body">
        @include('alpaca::error')
        @include('flash::message')
        @yield('content')
    </div>
</div>