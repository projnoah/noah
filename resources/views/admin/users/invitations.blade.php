@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.users.sub.invitations'))

@section('breadcrumb')
    <li><a href="@route('admin.users.index', [], false)" data-pjax><i class="icon-user"></i>&nbsp;@trans('views.admin.titles.users.sub.index')</a></li>
    <li class="active">@trans('views.admin.titles.users.sub.invitations')</li>
@stop

@section('app-content')
    <div class="row">
        @if(site('registrationOn'))
            <div class="col-xs-12 text-center">
                <h3>@trans('views.admin.pages.users.invitations.unavailable')</h3>
            </div>
        @else
            <div class="row">
                <div class="col-xs-12">
                    <blockquote>
                        {{-- TODO: --}}
                        <p>@trans('views.admin.pages.users.invitations.tips')</p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 clearfix">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h4 class="panel-title">@trans('views.admin.pages.users.invitations.heading')</h4>
                        </div>
                        <div class="panel-body">
                            <form action="@route('admin.users.invitations')" method="POST" class="col-xs-8 col-xs-offset-2">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label>@trans('views.admin.pages.users.invitations.quantity')</label>
                                    <select name="quantity" id="quantity-select" class="form-control" style="width: 100%;">
                                        @foreach([5,10,15,20,50] as $q)
                                            <option value="{{ $q }}">{{ $q }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary btn-block btn-rounded">@trans('views.admin.pages.users.invitations.generate')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 clearfix">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>@trans('views.admin.pages.users.invitations.table.code')</th>
                                    <th class="text-right">@trans('views.admin.pages.users.invitations.table.date')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($codes))
                                    @foreach($codes as $code)
                                    <tr>
                                        <td>{{ $code->code }}</td>
                                        <td class="text-right">{{ \Carbon\Carbon::parse($code->date)->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/invitations-users.js" pjax-script></script>
@endpush