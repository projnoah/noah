@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.services'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.services')</li>
@stop

@section('app-content')
    <div class="row">
        <nav class="tab-menu menu--nav">
            <ul class="menu__list nav nav-tabs" role="tablist">
                <li role="presentation" class="menu__item menu__item--current active"><a href="#oauth-tab" class="menu__link" role="tab" data-toggle="tab">@trans('views.admin.pages.settings.services.oauth.heading')</a></li>
                <li role="presentation" class="menu__item"><a href="#email-tab" class="menu__link" role="tab" data-toggle="tab">@trans('views.admin.pages.settings.services.email.heading')</a></li>
                <li role="presentation" class="menu__item"><a href="#push-tab" class="menu__link" role="tab" data-toggle="tab">@trans('views.admin.pages.settings.services.push.heading')</a></li>
                <li role="presentation" class="menu__item"><a href="#storage-tab" class="menu__link" role="tab" data-toggle="tab">@trans('views.admin.pages.settings.services.storage.heading')</a></li>
            </ul>
        </nav>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade in" id="oauth-tab">
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.oauth.heading')</h4>
                    </div>
                    <div class="panel-body">
                        <div class="clearfix m-b-md">
                            <blockquote>
                                <p>@trans('views.admin.pages.settings.services.oauth.tips')</p>
                            </blockquote>
                        </div>
                        @if(site('registrationOn'))
                        @include('admin.settings.partials.oauth', [
                            'service' => 'facebook',
                            'app_id' => 'APP_ID',
                            'app_secret' => 'APP_SECRET',
                            'apply_url' => 'https://developers.facebook.com/quickstarts/?platform=web'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Weibo',
                            'app_id' => 'APP_KEY',
                            'app_secret' => 'APP_SECRET',
                            'apply_url' => 'http://open.weibo.com/apps'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'QQ',
                            'app_id' => 'APP_ID',
                            'app_secret' => 'APP_KEY',
                            'apply_url' => 'http://connect.qq.com'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Google',
                            'app_id' => 'APP_ID',
                            'app_secret' => 'APP_SECRET',
                            'apply_url' => 'https://console.cloud.google.com/home/dashboard'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Weixin',
                            'app_id' => 'APP_ID',
                            'app_secret' => 'APP_SECRET',
                            'apply_url' => 'https://open.weixin.qq.com/'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Youtube',
                            'app_id' => 'APP_ID',
                            'app_secret' => 'APP_SECRET',
                            'apply_url' => 'https://console.cloud.google.com/home/dashboard'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Github',
                            'app_id' => 'Client_ID',
                            'app_secret' => 'Client_Secret',
                            'apply_url' => 'https://github.com/settings/applications/new'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Linkedin',
                            'app_id' => 'Client_ID',
                            'app_secret' => 'Client_Secret',
                            'apply_url' => 'https://www.linkedin.com/developer/apps'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Dribbble',
                            'app_id' => 'Client_ID',
                            'app_secret' => 'Client_Secret',
                            'apply_url' => 'https://dribbble.com/account/applications/new'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Disqus',
                            'app_id' => 'App_Key',
                            'app_secret' => 'App_Secret',
                            'apply_url' => 'https://disqus.com/home/settings/apps/'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Slack',
                            'app_id' => 'Client_ID',
                            'app_secret' => 'Client_Secret',
                            'apply_url' => 'https://api.slack.com/applications/new'
                        ])
                        @include('admin.settings.partials.oauth', [
                            'service' => 'Spotify',
                            'app_id' => 'Client_ID',
                            'app_secret' => 'Client_SECRET',
                            'apply_url' => 'https://developer.spotify.com/my-applications/#!/applications/create'
                        ])
                        @endif
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="email-tab">
                @include('admin.settings.partials.smtp')
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="push-tab">
                @include('admin.settings.partials.push')
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="storage-tab">
                @include('admin.settings.partials.storage')
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/services-settings.js" pjax-script></script>
@endpush