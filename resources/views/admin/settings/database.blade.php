@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced.database'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general', [], false)" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li><a href="@route('admin.settings.advanced.index')" data-pjax>@trans('views.admin.titles.settings.sub.advanced.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced.database')</li>
@stop

@section('app-content')
    <div class="row">
        @include('admin.settings.related.database-info')
    </div>
@stop


@push('scripts.footer')
<script src="/assets/js/admin/pages/database-settings.js" pjax-script></script>
@endpush