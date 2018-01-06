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
    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
<!-- Bootstrap CSS -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"--}}
    {{--integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">--}}
</head>
<body>

<div id="app">

    @include('alpaca::navbar.navbar')

    <div class="container">


        @include('alpaca::error')
        @include('flash::message')
        @include('alpaca::content')

    </div>

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-3">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">--}}
                        {{--Featured--}}
                    {{--</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--<a class="list-group-item" href="/backend/page">Page</a>--}}
                        {{--<a class="list-group-item" href="/backend/category">Category</a>--}}
                        {{--<a class="list-group-item" href="/backend/menu">Menu</a>--}}
                        {{--<a class="list-group-item" href="/backend/block">Block</a>--}}
                        {{--<a class="list-group-item" href="/backend/email-template">E-Mail Templates</a>--}}
                        {{--<a class="list-group-item" href="/contact">Contact</a>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-9">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-body">--}}
                        {{--@include('alpaca::error')--}}
                        {{--@include('flash::message')--}}
                        {{--@yield('content')--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <footer class="footer">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>

</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"--}}
{{--integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"--}}
{{--crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"--}}
{{--integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"--}}
{{--crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"--}}
{{--integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"--}}
{{--crossorigin="anonymous"></script>--}}
@if(!App::environment('testing'))
    <script src="{{ asset('js/app.js') }}"></script>
@endif
@include('alpaca::cookieconsent')
</body>
</html>