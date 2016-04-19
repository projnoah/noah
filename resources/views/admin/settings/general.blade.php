@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.general'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.general')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">@trans('views.admin.pages.settings.general.basics.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.settings.save-general', ['type' => 'basics'], false)" class="form-horizontal" method="POST" id="basics-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="site_title" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.site-title')</label>
                            <div class="col-sm-10">
                                <input name="site_title" type="text" class="form-control" value="@site('siteTitle')" v-model="Site.title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="home_uri" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.home-uri')</label>
                            <div class="col-sm-10">
                                <input name="home_uri" type="text" class="form-control" value="@site('homeUri')" v-model="Site.homeUri" required>
                                <small class="help-block">@trans('views.admin.pages.settings.general.basics.home-uri-help'): <a :href="'/' + Site.homeUri" target="_blank">@url('/')/@{{ Site.homeUri }}</a></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="social_uri" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.social-uri')</label>
                            <div class="col-sm-10">
                                <input name="social_uri" type="text" class="form-control" value="@site('socialUri')" v-model="Site.socialUri" required>
                                <small class="help-block">@trans('views.admin.pages.settings.general.basics.social-uri-help'): <a :href="'/' + Site.socialUri" target="_blank">@url('/')/@{{ Site.socialUri }}</a></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post_uri" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.post-uri')</label>
                            <div class="col-sm-10">
                                <input name="post_uri" type="text" class="form-control" value="@site('postUri')" v-model="Site.postUri" required>
                                <small class="help-block">@trans('views.admin.pages.settings.general.basics.post-uri-help'): <a :href="'/' + Site.postUri" target="_blank">@url('/')/@{{ Site.postUri }}</a></small>
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label for="admin_uri" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.admin-uri')</label>
                            <div class="col-sm-10">
                                <input name="admin_uri" type="text" class="form-control" value="@site('adminUri')" required>
                                <small class="help-block text-danger">@trans('views.admin.pages.settings.general.basics.admin-uri-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registration" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.registration-on')</label>
                            <div class="col-sm-10">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="registration" value="yes"{{ site('registrationOn') ? ' checked' : '' }}>
                                        @trans('views.admin.pages.settings.general.basics.registration-on-yes')
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="registration" value="no"{{ site('registrationOn') ? '' : ' checked' }}>
                                        @trans('views.admin.pages.settings.general.basics.registration-on-no')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="admin_email" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.basics.admin-email')</label>
                            <div class="col-sm-10">
                                <input name="admin_email" type="email" class="form-control" value="@site('adminEmail')" required>
                                <small class="help-block">@trans('views.admin.pages.settings.general.basics.admin-email-help')
                                    <a href="@route('admin.settings.services', [], false)" data-pjax>@trans('views.admin.pages.settings.general.basics.admin-email-setting')</a></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">@trans('views.admin.pages.settings.general.seo.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.settings.save-general', ['type' => 'seo'], false)" class="form-horizontal" method="POST" id="seo-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="site_separator" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.seo.separator')</label>
                            <div class="col-sm-10">
                                <input name="site_separator" class="form-control" type="text" value="@site('separator')" maxlength="5">
                                <small class="help-block">@trans('views.admin.pages.settings.general.seo.separator-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site_description" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.seo.description')</label>
                            <div class="col-sm-10">
                                <textarea name="site_description" class="form-control" rows="5" style="resize: vertical;">@site('description')</textarea>
                                <small class="help-block">@trans('views.admin.pages.settings.general.seo.description-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site_keywords" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.seo.keywords')</label>
                            <div class="col-sm-10">
                                <select name="site_keywords[]" multiple id="keywords-select" style="display: none; width: 100%">
                                    @foreach(explode(',', site('keywords')) as $keyword)
                                        <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                    @endforeach
                                </select>
                                <small class="help-block">@trans('views.admin.pages.settings.general.seo.keywords-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site_robot_ignores" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.seo.ignores')</label>
                            <div class="col-sm-10">
                                <select name="site_robot_ignores[]" multiple id="robots-select" style="display: none; width: 100%">
                                    @if(site('siteRobotIgnores'))
                                    @foreach(explode(',', site('siteRobotIgnores')) as $uri)
                                        <option value="{{ $uri }}" selected>{{ $uri }}</option>
                                    @endforeach
                                    @else
                                        <option value="{{ site('adminUri') }}" selected>{{ site('adminUri') }}</option>
                                    @endif
                                </select>
                                <small class="help-block">@trans('views.admin.pages.settings.general.seo.ignores-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.settings.general.region.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.settings.save-general', ['type' => 'region'], false)" class="form-horizontal" method="POST" id="region-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="timezone" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.region.timezone')</label>
                            <div class="col-sm-10">
                                {!! Timezone::selectForm(env('TIMEZONE', 'Asia/Hong_Kong'), '', ['name' => 'timezone', 'id' => 'timezone-select', 'style' => 'width: 100%']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="locale" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.region.locale')</label>
                            <div class="col-sm-10">
                                <select name="locale" id="locale-select" style="width: 100%">
                                    @foreach(Noah::supportedLocales() as $locale)
                                        <option value="{{ $locale }}"{{ app()->getLocale() === $locale ? ' selected' : '' }}>({{ $locale }}) @trans('locales.' . $locale)</option>
                                    @endforeach
                                </select>
                                <small class="help-block">@trans('views.admin.pages.settings.general.region.locale-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="auto_locale" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.region.auto-locale')</label>
                            <div class="col-sm-10">
                                <div class="ios-switch switch-lg">
                                    <input type="checkbox" name="auto_locale" class="js-switch"{{ site('autoLocale') == '0' ? '' : ' checked' }}>
                                    &nbsp;@trans('views.admin.pages.settings.general.region.auto-locale-on')
                                </div>
                                <small class="help-block">@trans('views.admin.pages.settings.general.region.auto-locale-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.settings.general.extra.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.settings.save-general', ['type' => 'extra'], false)" class="form-horizontal" method="POST" id="extra-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.extra.icp')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="icp" value="@site('icp')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="force_ssl" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.extra.ssl')</label>
                            <div class="col-sm-10">
                                <div class="ios-switch switch-lg">
                                    <input type="checkbox" name="force_ssl" class="js-switch" {{ site('forceSsl') == '0' ? '' : ' checked' }}>
                                    &nbsp;@trans('views.admin.pages.settings.general.extra.ssl-on')
                                </div>
                                <small class="help-block">@trans('views.admin.pages.settings.general.extra.ssl-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="powered_by" class="col-sm-2 control-label">@trans('views.admin.pages.settings.general.extra.powered-by')</label>
                            <div class="col-sm-10">
                                <div class="ios-switch switch-lg">
                                    <input type="checkbox" name="powered_by" class="js-switch" {{ site('poweredBy') == '0' ? '' : ' checked' }}>
                                    &nbsp;@trans('views.admin.pages.settings.general.extra.powered-by-on')
                                </div>
                                <small class="help-block">@trans('views.admin.pages.settings.general.extra.powered-by-help')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/general-settings.js" pjax-script></script>
@endpush