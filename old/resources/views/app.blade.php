<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    @include('partials.head')
</head>
<body>

@include('navbar')
@include('sidebar-left')

<div class="container">

    @include('flash::message')
    @include('partials.error')
    @include('block::content')

</div>

<footer>
    <div class="container">
        <p>
            <a class="{{ isActiveRoute('contact.show') }}" href="{{ route('contact.show') }}">Kontakt</a>
            -
            <a class="{{ isActiveUrl('/impressum') }}" href="/impressum">Impressum</a>

            <small class="pull-right">Copyright © - Alle Rechte vorbehalten</small>
        </p>
    </div>
</footer>

<div class="overlay"></div>

<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script defer src="{{ elixir('assets/theme/script.js') }}"></script>
@yield('scripts')
@include('cookieconsent::bar')
</body>
</html>