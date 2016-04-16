@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.settings.sub.advanced'))

@section('breadcrumb')
    <li><a href="@route('admin.settings.general')" data-pjax><span class="icon-equalizer"></span>&nbsp;@trans('views.admin.titles.settings.main')</a></li>
    <li class="active">@trans('views.admin.titles.settings.sub.advanced')</li>
@stop

@section('app-content')
    <div class="row">

    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/advanced-settings.js" pjax-script></script>
@endpush