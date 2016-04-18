@extends('layouts.base')

@section('content')
    <div class="noah-menu-wrap">
        <nav class="noah-menu-top">
            <div class="profile">
                <img src="{{ Auth::check() ? Auth::user()->avatarUrl : Noah\Avatar::defaultUrl() }}" alt=""/>
                <span>
                    @check
                    {{ Auth::user()->name }}
                    @else
                        请先登录
                    @endcheck
                </span>
            </div>
            <div class="icon-list">
                <a href="#"><i class="fa fa-fw fa-star-o"></i></a>
                <a href="#"><i class="fa fa-fw fa-bell-o"></i></a>
                <a href="#"><i class="fa fa-fw fa-envelope-o"></i></a>
                <a href="@route('exit')"><i class="fa fa-fw fa-sign-out"></i></a>
            </div>
        </nav>
        <nav class="noah-menu-side">
            <a href="#">我是菜单1</a>
            <a href="#">我是菜单2</a>
            <a href="#">我是菜单3</a>
            <a href="#">我是菜单4</a>
        </nav>
    </div>
    <div class="content-wrap">

        @include('layouts.partials.app-navbar')

        @yield('app.content')

        @include('layouts.partials.app-footer')

    </div>
@endsection