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
                <h4 class="panel-title"></h4>
            </div>
            <div class="panel-body text-center">
                <h1 class="icon-like" style="font-size: 25em;"></h1>
                <div class="row"><h1>已经是最新版本了</h1></div>
            </div>
        </div>
    </div>
@stop