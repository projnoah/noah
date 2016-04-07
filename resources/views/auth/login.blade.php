@extends('layouts.base')

@section('title', trans('views.auth.title'))

@push('styles')
    <link rel="stylesheet" href="/assets/css/pages/login.css">
@endpush

@section('content')
    <div class="container login-wrapper">
        <div class="login-panel" :class="{'register': isRegister, 'login' : !isRegister }" id="panel">
            <h1 class="title">@{{ title }}</h1>
            <form role="form" action="@{{ url }}" method="POST" class="pn-form" id="login-form">
                {!! csrf_field() !!}
                <div class="input-wrapper">
                    <span class="input input--login" v-for="input in inputs">
					    <input name="@{{ input.name }}" class="input__field input__field--login" type="@{{ input.type }}" id="input-@{{ input.name }}" maxlength="50" required="required" />
					    <label class="input__label input__label--login" for="@{{ input.name }}">
                            <span class="input__label-content input__label-content--login">&nbsp;@{{ input.text }}</span>
                        </label>
				    </span>
                </div>
                <div class="remember-wrapper" v-show="!isRegister">
                    <div class="remember-me-checkbox">
                        <input id="remember_me_cb" name="remember_me" type="checkbox">
                        <label class="label" for="remember_me_cb">@trans('views.auth.login.remember_me')</label>
                    </div>
                </div>
            </form>
            <ul class="social-login">
                <li><a class="social-link" href="@route('social', ['service' => 'weibo'])"><i class="fa fa-weibo"></i></a></li>
                <li><a class="social-link" href="@route('social', ['service' => 'qq'])"><i class="fa fa-qq"></i></a></li>
                <li><a class="social-link" href="@route('social', ['service' => 'github'])"><i class="fa fa-github"></i></a></li>
            </ul>
            <div class="login-options">
                <button class="forgot-password" data-dialog="reset-dialog">@trans('views.auth.login.forgot_password')</button>
                <button class="register-link" @click="toggleForm">@{{ switchButtonTitle }}</button>
            </div>
            <div class="progress-button-wrapper">
                <div class="progress-button">
                    <button @click="submitForm"><span>@{{ buttonTitle }}</span></button>
                    <svg class="progress-circle" width="70" height="70"><path d="m35,2.5c17.955803,0 32.5,14.544199 32.5,32.5c0,17.955803 -14.544197,32.5 -32.5,32.5c-17.955803,0 -32.5,-14.544197 -32.5,-32.5c0,-17.955801 14.544197,-32.5 32.5,-32.5z"/></svg>
                    <svg class="checkmark" width="70" height="70"><path d="m31.5,46.5l15.3,-23.2"/><path d="m31.5,46.5l-8.5,-7.1"/></svg>
                    <svg class="cross" width="70" height="70"><path d="m35,35l-9.3,-9.3"/><path d="m35,35l9.3,9.3"/><path d="m35,35l-9.3,9.3"/><path d="m35,35l9.3,-9.3"/></svg>
                </div>
            </div>
            <div class="logo-wrapper">
                <div class="powered">
                    <h5>Powered by</h5>
                    <img src="@url('assets/logo/PN.png')" alt="Project Noah">
                </div>
            </div>
        </div>
    </div>
    <password-reset-dialog></password-reset-dialog>
    <div class="blur-container"><div class="background-container"></div></div>
    <div class="overlay-container"></div>
@endsection

@push('scripts.footer')
    <script>
        const data = {
            isRegister: '{{ request()->url() === route('sign-in') ? 'false' : 'true' }}',
            login: {
                title: "@trans("views.auth.login.header_title")",
                url: "@route('sign-in')",
                inputs: [
                    {
                        text: "@trans('views.auth.login.username')",
                        name: "username",
                        type: 'text'
                    },
                    {
                        text: "@trans('views.auth.login.password')",
                        name: "password",
                        type: 'password'
                    }
                ]
            },
            register: {
                title: "@trans("views.auth.register.header_title")",
                url: "@route('sign-up')",
                inputs: [
                    {
                        text: "@trans('views.auth.register.username')",
                        name: "username",
                        type: 'text'
                    },
                    {
                        text: "@trans('views.auth.register.email')",
                        name: "email",
                        type: 'email'
                    },
                    {
                        text: "@trans('views.auth.register.password')",
                        name: "password",
                        type: 'password'
                    },
                    {
                        text: "@trans('views.auth.register.confirm_password')",
                        name: "password_confirmation",
                        type: 'password'
                    }
                ]
            },
            reset: {
                title: "@trans('views.auth.reset.title')",
                button: "@trans('views.auth.reset.button')",
                placeholder: "@trans('views.auth.reset.placeholder')",
                url: "@route('reset-password')"
            }
        };
        const redirectUrl = "{{ redirect()->intended()->getTargetUrl() }}";
    </script>
    <script src="/assets/js/pages/login.js"></script>
@endpush
