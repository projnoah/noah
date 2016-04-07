<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.emails.partials.styles')
    @stack('styles')
</head>
<body>
    <div id="wrapper">
        @include('layouts.emails.partials.header')

        <section>
            @unless(is_null($user))
            <nav class="hello">
                <span>Hi, {{ $user->name }}</span>
                <div class="avatar">
                    <img src="{{ $user->avatarUrl }}" alt="">
                </div>
            </nav>
            @endunless
            @yield('content')
        </section>

        @include('layouts.emails.partials.footer')
    </div>
</body>
</html>