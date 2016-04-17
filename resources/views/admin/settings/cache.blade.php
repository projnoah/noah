@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced.cache'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general', [], false)" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li><a href="@route('admin.settings.advanced.index')" data-pjax>@trans('views.admin.titles.settings.sub.advanced.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced.cache')</li>
@stop

@section('app-content')
    <div class="row">
    </div>
@stop


@push('scripts.footer')
<script src="/assets/js/admin/pages/cache-settings.js" pjax-script></script>
@endpush