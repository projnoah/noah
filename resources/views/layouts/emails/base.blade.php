<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    @stack('styles')
</head>
<body style="font-family: 'Avenir Next', 'PingFang SC', 'Microsoft Yahei', Arial, sans-serif;font-weight: 400;font-size: 18px;background: linear-gradient(to right, rgb(57, 82, 124), rgb(61, 99, 145));padding: 0;margin: 0;color: #fff;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">
@include('layouts.emails.partials.styles')

<div class="main-wrap"
     style="width: 100%;height: 100%;background: linear-gradient(to right, rgb(57, 82, 124), rgb(61, 99, 145));color: #eee;">
    <div id="wrapper"
         style="display: flex;justify-content: center;align-items: center;flex-direction: column;position: relative;padding: 0;margin: 0;background: linear-gradient(to right, rgb(57, 82, 124), rgb(61, 99, 145));">
        @include('layouts.emails.partials.header')

        <div class="section"
             style="background: linear-gradient(to bottom, rgba(25, 5, 15, 0.3), rgba(5, 5, 5, 0.25));max-width: 850px;min-width: 220px;padding: 4em 2.8em;box-shadow: 0 0 7px rgba(200,20,10, 0.35);margin: .5em 5em;border-radius: 12px;display: flex;justify-content: center;align-items: center;flex-direction: column;">
            @unless(is_null($user))
                <div class="hello"
                     style="display: flex;justify-content: center;align-items: center;position: relative;margin-bottom: 2.5em;width: 100%;">
                    <span style="flex: 5;color: #c3d9b3;font-size: 1.58em;font-weight: 600;text-align: left;">Hi, {{ $user->name }}</span>
                    <div class="avatar" style="flex: 1;max-width: 130px;max-height: 130px">
                        <img src="{{ $user->avatarUrl }}" alt="{{ $user->name }}" width="100%"
                             style="width: 100%;display: block;border-radius: 50%;">
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