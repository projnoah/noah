@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.users.sub.profile'))

@section('breadcrumb')
    <li><a href="@route('admin.users.index', [], false)" data-pjax>@trans('views.admin.titles.users.sub.index')</a></li>
    <li class="active">@trans('views.admin.titles.users.sub.profile')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.users.profile.basics.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.users.profile.save', [], false)" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        {!! method_field('PATCH') !!}
                        <div class="form-group">
                            <label class="col-md-2 control-label">@trans('validation.attributes.username')</label>
                            <div class="col-md-10">
                                <input type="text" name="username" class="form-control" v-model="User.username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">@trans('validation.attributes.name')</label>
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" v-model="User.name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">@trans('validation.attributes.email')</label>
                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control" v-model="User.email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary btn-block btn-rounded">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.users.profile.password.heading')</h4>
                </div>
                <div class="panel-body">
                    <form action="@route('admin.users.profile.update-password')" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        {!! method_field('PATCH') !!}
                        <div class="form-group">
                            <label class="col-md-2 control-label">@trans('validation.attributes.password')</label>
                            <div class="col-md-10">
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">@trans('validation.attributes.password_confirmation')</label>
                            <div class="col-md-10">
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-danger btn-block btn-rounded">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">@trans('views.admin.pages.users.profile.social.heading')</h4>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="row">
                            @if(Noah::activeOAuths()->count())
                                @foreach(Noah::activeOAuths() as $service)
                                    <form action="@route('admin.users.profile.oauth', compact('service'), false)" id="{{ $service }}-oauth" method="POST" class="p-v-md">
                                        {!! csrf_field() !!}
                                        <div class="col-md-8 col-sm-7 col-xs-6">
                                            <b class="{{ $service }}-colored" style="text-transform: capitalize"><i class="fa fa-{{ $service }}"></i>&nbsp;{{ $service == 'qq' ? 'QQ' : $service }}</b>
                                        </div>
                                        <div class="col-md-4 col-sm-5 col-xs-6">
                                            @if(Auth::user()->boundOAuth($service))
                                                <button type="submit" class="btn btn-danger btn-block btn-rounded">解除绑定</button>
                                            @else
                                                <button type="submit" class="btn btn-success btn-block btn-rounded">绑定</button>
                                            @endif
                                        </div>
                                    </form>
                                @endforeach
                            @else
                                <div class="text-center p-bottom">
                                    <h3>@trans('views.admin.pages.users.profile.social.not-found')</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/profile-users.js" pjax-script></script>
@endpush