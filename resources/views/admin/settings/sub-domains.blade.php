@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced.sub-domains'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced.sub-domains')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white p-v-md">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.titles.settings.sub.advanced.sub-domains')</h4>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <form action="@route('admin.settings.advanced.sub-domains', [], false)" method="POST" class="form-horizontal">
                            {!! csrf_field() !!}
                            {!! method_field('PATCH') !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">@trans('views.admin.pages.settings.advanced.sub-domains.avatar-sub-domain')</label>
                                <div class="ios-switch switch-md col-sm-9">
                                    <input type="checkbox" name="avatar_sub_domains_switch" class="js-switch"{{ site('avatarsSubDomain') ? ' checked' : '' }}>
                                    @trans('views.admin.pages.settings.advanced.sub-domains.switch')
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">@trans('views.admin.pages.settings.advanced.sub-domains.avatar-uri')</label>
                                <div class="col-sm-9">
                                    <input name="avatar_domain_name" type="text" class="form-control" value="{{ site('avatarSubDomainName') ?: 'avatars' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">@trans('views.admin.pages.settings.advanced.sub-domains.user-sub-domain')</label>
                                <div class="ios-switch switch-md col-sm-9">
                                    <input type="checkbox" name="user_sub_domains_switch" class="js-switch"{{ site('usersSubDomain') ? ' checked' : '' }}>
                                    @trans('views.admin.pages.settings.advanced.sub-domains.switch')
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">@trans('views.admin.pages.settings.advanced.sub-domains.sub-domain-name-exclusion')</label>
                                <div class="col-sm-9">
                                    <input name="sub_domain_name_exclusion" type="text" class="form-control" value="{{ site('subDomainNameExclusion') ?: 'avatars' }}">
                                </div>
                            </div>
                            <div class="form-group m-t-xs">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-block btn-primary btn-rounded" type="submit">@trans('views.admin.pages.settings.update-button')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop