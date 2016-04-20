@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.data-center.sub.index'))

@section('breadcrumb')
    <li class="active"><i class="icon-support"></i>&nbsp;@trans('views.admin.titles.data-center.main')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-white info-box">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{ Stat::totalUsers() }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.data-center.index.total-users')</span>
                    </div>
                    <div class="info-box-icon"><i class="icon-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-white info-box">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{ Stat::totalPageViews() }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.data-center.index.total-page-views')</span>
                    </div>
                    <div class="info-box-icon"><i class="icon-eye"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-white info-box">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{ Stat::totalBlogs() }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.data-center.index.total-blogs')</span>
                    </div>
                    <div class="info-box-icon"><i class="icon-note"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-white info-box">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{ Stat::totalComments() }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.data-center.index.total-comments')</span>
                    </div>
                    <div class="info-box-icon"><i class="icon-bubbles"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.data-center.index.visitor-records')</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="col-xs-4 text-right">@trans('views.admin.pages.data-center.index.most', ['item' => trans('views.admin.pages.data-center.index.attributes.browser')])</th>
                            <td class="col-xs-4">{{ Stat::mostBrowser()->name }}</td>
                        </tr>
                        <tr>
                            <th class="col-xs-6 text-right">@trans('views.admin.pages.data-center.index.most', ['item' => trans('views.admin.pages.data-center.index.attributes.platform')])</th>
                            <td class="col-xs-6">{{ Stat::mostPlatform()->name }}</td>
                        </tr>
                        <tr>
                            <th class="col-xs-6 text-right">@trans('views.admin.pages.data-center.index.most', ['item' => trans('views.admin.pages.data-center.index.attributes.city')])</th>
                            <td class="col-xs-6">{{ Stat::mostCity()->name }}</td>
                        </tr>
                        <tr>
                            <th class="col-xs-6 text-right">@trans('views.admin.pages.data-center.index.most', ['item' => trans('views.admin.pages.data-center.index.attributes.device')])</th>
                            <td class="col-xs-6">{{ Stat::mostDevice()->name }}</td>
                        </tr>
                        <tr>
                            <th class="col-xs-6 text-right">@trans('views.admin.pages.data-center.index.most', ['item' => trans('views.admin.pages.data-center.index.attributes.uri')])</th>
                            <td class="col-xs-6">{{ Stat::mostUri()->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-white">
                <div class="panel-body">
                    <b>@trans('views.unavailable.in-development')</b>
                </div>
            </div>
        </div>
    </div>
@stop