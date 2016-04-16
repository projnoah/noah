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
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="email-tab">
                @include('admin.settings.partials.smtp')
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="push-tab">
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.push.heading')</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <blockquote>
                                <p>@trans('views.admin.pages.settings.services.push.tips')</p>
                            </blockquote>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-transparent">
                                    <div class="panel-heading facebook-colored-bg">
                                        <h4 class="panel-title">Pusher</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form action="@route('admin.settings.save-push')" method="POST" class="form-horizontal" id="pusher-form">
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="on"{{ site('pusherOn') == '1' ? ' checked' : '' }}>@trans('views.admin.pages.settings.services.push.pusher.on')
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">App_ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="app_id" value="{{ env('PUSHER_APP_ID') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Key</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="key" value="{{ env('PUSHER_KEY') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Secret</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" value="{{ env('PUSHER_SECRET') }}" name="secret">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <blockquote>
                                                    <h4>@trans('views.admin.pages.settings.services.oauth.apply')</h4>
                                                    <p><a href="https://dashboard.pusher.com/" target="_blank">https://dashboard.pusher.com/</a></p>
                                                </blockquote>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit"
                                                            class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active fade in" id="storage-tab">
                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.heading')</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <blockquote>
                                <p>@trans('views.admin.pages.settings.services.storage.tips')</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/services-settings.js" pjax-script></script>
@endpush