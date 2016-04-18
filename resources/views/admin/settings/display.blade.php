@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.display'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.display')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">@trans('views.admin.pages.settings.display.upload-logo.title')</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <p>@trans('views.admin.pages.settings.display.upload-logo.upload-tips')</p>
                    </div>
                    <div class="row m-b-xs">
                        <div class="col-xs-4 col-xs-offset-4" style="border: 2px dashed rgba(0,0,0,0.15);border-radius: 5%;padding: 10px;">
                            <img id="logo-img" src="/assets/logo.png?ver={{ site('logoVersion') ?: 0 }}" alt="Logo" class="img-rounded" style="max-width: 99%;">
                        </div>
                    </div>
                    <form action="@route('admin.settings.display.upload-logo', [], false)" method="POST" class="no-ajax" enctype="multipart/form-data">
                        <div class="text-center form-group">
                            <input type="file" name="logo" id="logo-file" class="input-file input-uploader" accept="image/png,image/jpeg,image/gif" />
                            <label for="logo">
                                <figure class="icon-cloud-upload"></figure>
                                <span>@trans('views.admin.pages.settings.display.upload-logo.upload')&hellip;</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/display-settings.js" pjax-script></script>
@endpush