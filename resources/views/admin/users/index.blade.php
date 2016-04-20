@extends('layouts.admin-app')

@section('title', isset($keyword) ? trans('views.admin.pages.users.index.search-heading', compact('keyword')) : trans('views.admin.titles.users.sub.index'))

@section('breadcrumb')
    <li class="active"><i class="icon-user"></i>&nbsp;@trans('views.admin.titles.users.sub.index')</li>
@stop

@section('app-content')
    <div class="row">
        <div class="panel panel-white">
            <div class="panel-heading">
                <a href="@route('admin.users.index', [], false)" data-pjax>
                    <h4 class="panel-title">
                        @trans('views.admin.pages.users.index.heading')
                    </h4>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <b>@trans('views.admin.pages.users.index.table.count', [
                            'perPage' => $users->perPage(),
                            'total' => $users->total()
                        ])</b>
                    </div>
                    <div class="col-sm-4 text-right">
                        <form :action="'@route('admin.users.search', ['keyword' => ''], false)/'+keyword" method="GET" class="pjax no-ajax">
                            <input type="text" class="form-control input-rounded search-input"
                                   placeholder="@trans('views.admin.pages.users.index.search')..." v-model="keyword" value="{{ isset($keyword) ? $keyword : '' }}" required>
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                </div>
                <div class="row">

                </div>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>
                            <div class="ios-switch switch-sm">
                                <input type="checkbox" class="js-switch">
                                #
                            </div>
                        </th>
                        <th>@trans('validation.attributes.name')</th>
                        <th>@trans('validation.attributes.username')</th>
                        <th>@trans('validation.attributes.email')</th>
                        <th>@trans('views.admin.pages.users.index.table.registered_at')</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>
                            <div class="ios-switch switch-sm">
                                <input type="checkbox" class="js-switch">
                                #
                            </div>
                        </th>
                        <th>@trans('validation.attributes.name')</th>
                        <th>@trans('validation.attributes.username')</th>
                        <th>@trans('validation.attributes.email')</th>
                        <th>@trans('views.admin.pages.users.index.table.registered_at')</th>
                        <th>&nbsp;</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse($users as $user)
                        <tr user-id="{{ $user->id }}">
                            <th scope="row">
                                <div class="ios-switch switch-sm">
                                    <input type="checkbox" class="js-switch">
                                    {{ $user->id }}
                                </div>
                            </th>
                            <td>
                                <a href="#" class="btn-block btn-naked">
                                    <img class="user-avatar img-circle" src="{{ $user->avatarUrl }}"
                                         alt="{{ $user->name }}">
                                    <span>{{ $user->name }}</span>
                                </a>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <time datetime="{{ $user->created_at->format('Y-m-d H:i:s') }}">
                                    {{ $user->created_at->diffForHumans() }}
                                </time>
                            </td>
                            <td class="text-center">
                                <a href="#" class="m-l-sm text-primary btn-naked"><i class="icon-pencil"
                                                                                     style="font-size: 1.4em"></i></a>
                                <a href="#" class="m-l-sm text-danger btn-naked"><i class="icon-close"
                                                                                    style="font-size: 1.4em"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                <div class="text-center row">
                    {!! $users->links() !!}
                </div>
                <div class="row text-center text-primary">
                    <b>@trans('views.admin.pages.users.index.table.count', [
                            'perPage' => $users->perPage(),
                            'total' => $users->total()
                        ])</b>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/index-users.js" pjax-script></script>
@endpush