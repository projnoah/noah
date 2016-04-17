@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced.cache'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general', [], false)" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li><a href="@route('admin.settings.advanced.index')" data-pjax>@trans('views.admin.titles.settings.sub.advanced.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced.cache')</li>
@stop

@section('app-content')
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <h4 class="panel-title text-center">@trans('views.admin.pages.settings.advanced.cache.title')</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <blockquote>
                    <h5>@trans('views.admin.pages.settings.advanced.cache.tips')</h5>
                </blockquote>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-6 col-md-offset-2">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <h4 class="col-lg-8 col-md-6 col-xs-4">@trans('views.admin.pages.settings.advanced.cache.main-cache')</h4>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <form action="@route('admin.settings.advanced.do-cache', ['type' => 'main-cache'], false)" id="main-refresh-form" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <button type="submit" class="btn btn-success btn-rounded btn-block">@trans('views.admin.pages.settings.advanced.cache.refresh')</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <form action="@route('admin.settings.advanced.do-cache', ['type' => 'main-cache', 'action' => 'clear'], false)" id="main-clear-form" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <button type="submit" class="btn btn-danger btn-rounded btn-block">@trans('views.admin.pages.settings.advanced.cache.clear')</button>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="text-danger">@trans('views.admin.pages.settings.advanced.cache.main-cache-warning')</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-lg-8 col-md-6 col-xs-4">@trans('views.admin.pages.settings.advanced.cache.route-cache')</h4>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <form action="@route('admin.settings.advanced.do-cache', ['type' => 'route-cache'], false)" id="route-refresh" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <button type="submit" class="btn btn-success btn-rounded btn-block">@trans('views.admin.pages.settings.advanced.cache.refresh')</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <form action="@route('admin.settings.advanced.do-cache', ['type' => 'route-cache', 'action' => 'clear'], false)" id="route-clear" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <button type="submit" class="btn btn-danger btn-rounded btn-block">@trans('views.admin.pages.settings.advanced.cache.clear')</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-md-10">@trans('views.admin.pages.settings.advanced.cache.view-cache')</h4>
                                    <div class="col-lg-2 col-md-3 col-xs-4">
                                        <form action="@route('admin.settings.advanced.do-cache', ['type' => 'view-cache', 'action' => 'clear'], false)" id="view-cache" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('PATCH') !!}
                                            <button type="submit" class="btn btn-danger btn-rounded btn-block">@trans('views.admin.pages.settings.advanced.cache.clear')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop