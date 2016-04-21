@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.data-center.sub.factory'))

@section('breadcrumb')
    <li><a href="@route('admin.center.index')"><i class="icon-support"></i>&nbsp;@trans('views.admin.titles.data-center.main')</a></li>
    <li class="active">@trans('views.admin.titles.data-center.sub.factory')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="col-xs-12 clearfix">
            <h3>@trans('views.admin.pages.data-center.factory.heading')</h3>
            <blockquote>
                <p>@trans('views.admin.pages.data-center.factory.tips')</p>
            </blockquote>
        </div>
        <div class="col-sm-8 col-sm-offset-2 clearfix">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="col-sm-10 col-sm-offset-1">
                        <form action="@route('admin.center.factory', [], false)" method="POST" id="factory-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="control-label">@trans('views.admin.pages.data-center.factory.model')</label>
                                <select name="model" id="model-select" class="form-control" style="width: 100%;">
                                    @foreach(['user', 'blog'] as $model)
                                        <option value="{{ $model }}">@trans('views.admin.pages.data-center.factory.models.' . $model)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">@trans('views.admin.pages.data-center.factory.quantity')</label>
                                <select name="quantity" id="quantity-select" class="form-control" style="width: 100%;">
                                    @foreach([5,10,25,50,70,100,150,200] as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                <small class="help-block">@trans('views.admin.pages.data-center.factory.quantity-tips')</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block btn-rounded">@trans('views.admin.pages.data-center.factory.create')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/factory-center.js" pjax-script></script>
@endpush