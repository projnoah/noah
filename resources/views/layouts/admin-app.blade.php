@extends('layouts.admin-base')

@section('content')
    <div class="overlay"></div>
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
        <h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
        <div class="slimscroll">
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
            <a href="javascript:void(0);" class="showRight2"><img src="{{ Auth::user()->avatarUrl }}" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
        </div>
    </nav>
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
        <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
        <div class="slimscroll chat">
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="{{ Auth::user()->avatarUrl }}" alt="">
                </div>
                <div class="chat-message">
                    Hi There!
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Hi! How are you?
                </div>
            </div>
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="{{ Auth::user()->avatarUrl }}" alt="">
                </div>
                <div class="chat-message">
                    Fine! do you like my project?
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Yes, It's clean and creative, good job!
                </div>
            </div>
            <div class="chat-item chat-item-left">
                <div class="chat-image">
                    <img src="{{ Auth::user()->avatarUrl }}" alt="">
                </div>
                <div class="chat-message">
                    Thanks, I tried!
                </div>
            </div>
            <div class="chat-item chat-item-right">
                <div class="chat-message">
                    Good luck with your sales!
                </div>
            </div>
        </div>
        <div class="chat-write">
            <form class="form-horizontal" action="javascript:void(0);">
                <input type="text" class="form-control" placeholder="Say something">
            </form>
        </div>
    </nav>
    <div class="menu-wrap">
        <nav class="profile-menu">
            <div class="profile"><img :src="User.avatarUrl" width="60" alt="@{{ User.name }}"/><span>@{{ User.name }}</span></div>
            <div class="profile-menu-list">
                <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a>
                <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a>
                <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a>
                <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a>
            </div>
        </nav>
        <button class="close-button" id="close-button">Close Menu</button>
    </div>
    <form class="search-form" action="#" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Search...{{ time() }}">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
        </div><!-- Input Group -->
    </form><!-- Search Form -->
    <main class="page-content content-wrap">

        @include('layouts.partials.admin.navbar')

        @include('layouts.partials.admin.sidebar')

        <div class="page-inner" id="pjax-container">
            @include('layouts.partials.admin.breadcrumb')

            <div id="main-wrapper">
                @yield('app-content')
            </div><!-- Main Wrapper -->

            @include('layouts.partials.admin.footer')
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
    @include('layouts.partials.admin.quick-menu')
@stop