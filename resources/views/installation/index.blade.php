<!doctype html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@trans('views.installation.steps.' . $step) - @trans('views.installation.title')</title>

    <link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/pages/install.css">

    <link rel="icon" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.png">

    <script src="/assets/js/modernizr.custom.js"></script>
</head>
<body>
    <div class="container">
        @if(count($errors))
            <div class="errors">
                <span>{{ $errors->first() }}</span>
            </div>
        @endif
        @if(session()->has('status'))
            <div class="step-title">
                <h2>@trans('views.installation.subtitles.' . $step)</h2>
            </div>
            <div class="step-detail">
                <ol class="progress" data-info="@trans('views.installation.confirm_title')">
                    @foreach(session('status') as $message)
                    <li class="progress-check">
                        <span class="progress-icon progress-{{ $message['type'] }}"></span>
                        <span class="directory-detail">{{ $message['detail'] }}</span>
                    </li>
                    @endforeach
                    <li class="progress-check">
                    @if(session('succeeded') == 1)
                        @if($step == 1)
                            <a href="@route('install', ['step' => $step + 1])">
                                @trans('views.installation.success.next')
                            </a>
                        @endif
                    @else
                        <a href="{{ url()->current() }}">
                            @trans('views.installation.refresh')
                        </a>
                    @endif
                    </li>
                </ol>
            </div>
        @else
        <div class="fs-form-wrap" id="fs-form-wrap">
            <div class="fs-title">
                <h1>@trans('views.installation.steps.' . $step)</h1>
            </div>
            @include('installation.partials.step-' . $step)
        </div>
        @endif
    </div>
    <script>
        const confirm_tip = "@trans('views.installation.confirm_tip')",
                next_button = "@trans('views.installation.next')";
    </script>
    <script src="/assets/js/pages/install.js"></script>
    @unless(session()->has('status'))
    <script>
        (function () {
            var formWrap = document.getElementById('fs-form-wrap');

            new FForm(formWrap, {
                onReview: function () {
                    classie.add(document.body, 'overview');
                }
            });
            FForm.prototype._showError = function (err) {
                var message = '';
                switch (err) {
                    case 'EMPTY':
                        message = '@trans('views.installation.errors.empty')';
                        break;
                    case 'INVALID_EMAIL':
                        message = '@trans('views.installation.errors.email')';
                        break;
                };
                this.msgError.innerHTML = message;
                this._showCtrl(this.msgError);
            }
        })();
    </script>
    @endunless
</body>
</html>