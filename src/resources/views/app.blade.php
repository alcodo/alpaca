<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon"/>
    <link rel="canonical" href="{{ $canonical or Request::url() }}"/>
    {!! SEO::generate() !!}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ elixir('assets/theme/style.css') }}"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('navbar')

<div class="container">

    @include('flash::message')
    @include('error')
    @include('block::content')

</div>

<footer class="area-footermenu container">
    <div class="col-sm-6 col-xs-12 text-right">
        © 2015 LaravelCMF
    </div>
</footer>

<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script defer src="{{ elixir('assets/theme/script.js') }}"></script>
@yield('scripts')
</body>
</html>