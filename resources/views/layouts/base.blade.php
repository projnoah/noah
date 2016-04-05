@include('layouts.partials.auxiliaries.html-copyright')
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $site::description() }}">
    <meta name="keywords" content="{{ $site::keywords() }}">
    <meta property="qc:admins" content="7750222037267106456" />
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ $site::title() }}</title>

    {{-- Fonts --}}
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.useso.com/css?family=Lato:100,300,400,700" rel='stylesheet'>
    {{-- Styles --}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/app.css">

    {{-- Styles Stack --}}
    @stack('styles')

    {{-- Favicons --}}
    <link rel="icon" href="{{ url('favicon.png') }}">
    <link rel="shortcut icon" href="{{ url('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ url('favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('favicon.png') }}">

    <!--[if IE]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/js/modernizr.custom.js"></script>

    {{-- Scripts Stack --}}
    @stack('scripts.header')

</head>
<body id="app">

    @yield('content')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="/assets/js/app.js"></script>

    {{-- Scripts Stack --}}
    @stack('scripts.footer')
</body>
</html>
