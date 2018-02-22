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
    @include('alpaca::partials.head')
</head>
<body>
@include('alpaca::partials.body')

<div id="app">

    @include('alpaca::navbar.navbar')

    <main class="container py-4">
        @include('alpaca::blockWrapper')
    </main>

    @include('alpaca::partials.footer')

</div>

@if(!App::environment('testing'))
    <script defer src="{{ asset('/js/app.js') }}"></script>
@endif
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
@include('alpaca::cookieconsent')
@yield('scripts')
</body>
</html>