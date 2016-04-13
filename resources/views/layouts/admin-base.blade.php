<!doctype html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title') @site('title')</title>

    {{-- Fonts --}}
    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- Styles --}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/admin/app.css">

    @if(Auth::user()->meta('admin.theme'))
        <link href="/assets/css/admin/themes/{{ Auth::user()->meta('admin.theme')->theme }}.css" class="theme-color" rel="stylesheet">
    @else
        <link href="/assets/css/admin/themes/dark.css" class="theme-color" rel="stylesheet">
    @endif

    {{-- Styles Stack --}}
    @stack('styles')

    {{-- Favicons --}}
    <link rel="icon" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/favicon.png">

    <!--[if IE]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/js/modernizr.custom.js"></script>
    <script src="/assets/js/admin/snap.svg-min.js"></script>

    <script>
        @if(Auth::user()->meta('admin.theme'))
        var THEME_COLOR = "{{ Auth::user()->meta('admin.theme')->color }}";
        @endif
    </script>
    {{-- Scripts Stack --}}
    @stack('scripts.header')
</head>
<body class="page-header-fixed">

    @yield('content')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="/assets/js/admin/app.js"></script>

    {{-- Scripts Stack --}}
    @stack('scripts.footer')

</body>
</html>