<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    @if(!App::environment('testing'))
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        @yield('css')
    @endif
    <link rel="shortcut icon" href="/favicon.ico"/>
</head>
<body>

<div id="app">

    @include('alpaca::navbar.navbar')

    <div class="container">

        @include('alpaca::blockWrapper')

    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>

</div>

@if(!App::environment('testing'))
    <script src="{{ asset('js/app.js') }}"></script>
@endif
@include('alpaca::cookieconsent')
@yield('scripts')
</body>
</html>