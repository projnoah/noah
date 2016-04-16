<!doctype html>
<html>
<head>
    <meta charset="UTF-8">

    @include('layouts.emails.partials.styles')
    @stack('styles')
</head>
<body>
    <div class="main-wrap">
        <div id="wrapper">
            @include('layouts.emails.partials.header')

            <div class="section">
                @unless(is_null($user))
                    <div class="hello">
                        <span>Hi, {{ $user->name }}</span>
                        <div class="avatar">
                            <img src="{{ $user->avatarUrl }}" alt="">
                        </div>
                    </div>
                @endunless
                @yield('content')
            </div>

            @include('layouts.emails.partials.footer')
        </div>
    </div>
</body>
</html>