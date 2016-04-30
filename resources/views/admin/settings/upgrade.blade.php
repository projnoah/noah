@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.upgrade'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active"><i class="icon-present"></i>&nbsp;@trans('views.admin.titles.settings.sub.upgrade')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="panel panel-white p-v-md">
            <div class="panel-heading">
                <h4 class="panel-title">@trans('views.admin.pages.settings.upgrade.heading')</h4>
            </div>
            <div class="panel-body text-center">
                @if(($version = Noah::getNewVersion()) == noah_version())
                    <div class="latest-version">
                        <h1 class="icon-like" style="font-size: 23em;"></h1>
                        <div class="row"><h1>@trans('views.admin.pages.settings.upgrade.latest-version')</h1></div>
                    </div>
                @else
                    <div class="new-version-gift new-version-available">
                        <img src="/assets/images/new-version.png" alt="" style="cursor: pointer;">
                    </div>
                    <div class="row">
                        <h3>@trans('views.admin.pages.settings.upgrade.new-version'): Noah v{{ Noah::getNewVersion() }}</h3>
                    </div>
                    <div class="row m-t-sm" id="upgrade-progress" style="display: none;">
                        <div class="col-xs-10 col-xs-offset-1">
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 5%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-left m-t-sm col-xs-10 col-xs-offset-1">
                        <div class="well text-primary text-center">
                            <h3>@trans('views.admin.pages.settings.upgrade.details'):</h3>
                            <p class="f-bold" id="upgrade-description"><i class="fa fa-spin fa-spinner"></i></p>
                        </div>
                        <blockquote class="upgrade-logs">
                        </blockquote>
                    </div>
                    <div class="row clearfix text-center text-danger">
                        <p>@trans('views.admin.pages.settings.upgrade.tips')</p>
                        <p>@trans('views.admin.pages.settings.upgrade.manual') <a href="https://upgrade.projnoah.com" target="_blank">@trans('views.admin.pages.settings.upgrade.official')</a></p>
                    </div>
                    <form action="@route('admin.settings.upgrade')" class="hidden" id="upgrade-form"></form>
                @endif
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script>var upgradeQueryUrl = '{{ Noah::getUpgradeQueryUrl() }}', upgradeCompleteMessage = '@trans('views.upgrades.complete')';</script>
<script src="/assets/js/admin/pages/upgrade-settings.js" pjax-script></script>
@endpush