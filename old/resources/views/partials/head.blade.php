<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{--CSRF Token--}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{!! SEO::generate() !!}

<link rel="shortcut icon" href="/favicon.ico"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{ elixir('assets/theme/style.css') }}"/>
@yield('css')

{{--Scripts--}}
<script>
    window.Laravel = {"csrfToken":"{{ csrf_token() }}"}
</script>