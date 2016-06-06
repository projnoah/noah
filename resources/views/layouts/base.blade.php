@include('layouts.partials.auxiliaries.html-copyright')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@site('description')">
    <meta name="keywords" content="@site('keywords')">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title') @site('title')</title>

    {{-- Fonts --}}
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    {{-- Styles --}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/app.css">

    {{-- Styles Stack --}}
    @stack('styles')

    {{-- Favicons --}}
    <link rel="icon" href="/assets/logo.png?ver={{ site('logoVersion') ?: 0 }}">
    <link rel="shortcut icon" href="/assets/logo.png?ver={{ site('logoVersion') ?: 0 }}">
    <link rel="apple-touch-icon" href="/assets/logo.png?ver={{ site('logoVersion') ?: 0 }}">
    <link rel="apple-touch-icon-precomposed" href="/assets/logo.png?ver={{ site('logoVersion') ?: 0 }}">

    <!--[if IE]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/js/modernizr.custom.js"></script>

    {{-- Scripts Stack --}}
    @stack('scripts.header')

    <script>
        const Site = {
            title: "@site('title')",
        };
        @check
        const User = JSON.parse('{!! Auth::user() !!}');
        @endcheck
    </script>
</head>
<body id="app">

    @yield('content')

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="/assets/js/app.js"></script>
    <script src="//cdn.bootcss.com/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
    <script>
        $(document).pjax('a', '#pjax-container');
    </script>
    {{-- Scripts Stack --}}
    @stack('scripts.footer')
</body>
</html>
