@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced.develop'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general', [], false)" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li><a href="@route('admin.settings.advanced.index')" data-pjax>@trans('views.admin.titles.settings.sub.advanced.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced.develop')</li>
@stop

@section('app-content')
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.advanced.warning-title')</h4>
                    </div>
                    <div class="panel-body">
                        <p>@trans('views.admin.pages.settings.advanced.warning-text')</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.advanced.develop.title')</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.advanced.save-develop', [], false)" method="POST" class="form-horizontal" id="develop-form">
                            {!! csrf_field() !!}
                            <div class="form-group cell">
                                <label class="col-xs-12">@trans('views.admin.pages.settings.advanced.develop.environment')</label>
                                <div class="col-xs-12">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="environment" value="local"{{ app()->isLocal() ? ' checked' : '' }}>
                                            @trans('views.admin.pages.settings.advanced.develop.environment-local')
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="environment" value="production"{{ app()->isLocal() ? '' : ' checked' }}>
                                            @trans('views.admin.pages.settings.advanced.develop.environment-production')
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group cell">
                                <div class="col-xs-10">
                                    <label>@trans('views.admin.pages.settings.advanced.develop.debug')</label>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="ios-switch switch-md">
                                        <input type="checkbox" class="js-switch" name="debug"{{ config('app.debug') ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <small class="help-block text-primary">@trans('views.admin.pages.settings.advanced.develop.debug-tips')</small>
                                </div>
                            </div>
                            <div class="form-group cell">
                                <div class="col-xs-10">
                                    <label>@trans('views.admin.pages.settings.advanced.develop.maintenance')</label>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="ios-switch switch-md">
                                        <input type="checkbox" class="js-switch" name="maintenance"{{ app()->isDownForMaintenance() ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <small class="help-block text-danger">@trans('views.admin.pages.settings.advanced.develop.maintenance-tips')</small>
                                    <b class="help-block text-danger">@trans('views.admin.pages.settings.advanced.develop.maintenance-warning')</b>
                                </div>
                            </div>
                            <div class="form-group cell">
                                <div class="col-xs-10">
                                    <label>@trans('views.admin.pages.settings.advanced.develop.admin-ignores')</label>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <div class="ios-switch switch-md">
                                        <input type="checkbox" class="js-switch" name="ignores_admin"{{ site('adminIgnoresMaintenance') ? ' checked' : '' }}>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <small class="help-block text-primary">@trans('views.admin.pages.settings.advanced.develop.admin-ignores-tips')</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-danger btn-block">@trans('views.admin.pages.settings.update-button')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-12">
                @include('admin.settings.related.advanced-server-info')
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/advanced-settings.js" pjax-script></script>
@endpush