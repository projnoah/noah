@extends('layouts.app')

@section('title', trans('views.dashboard.home.title'))

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
                <a href="#"><i class="fa fa-fw fa-comment-o"></i></a>
            </div>
        </nav>
        <nav class="noah-menu-side">
            <a href="#">Recent Stories</a>
            <a href="#">Reading List</a>
            <a href="#">My Stories</a>
            <a href="#">Categories</a>
        </nav>
    </div>
    <div class="content-wrap">
        <nav class="dashboard-nav">
            <div class="nav-wrapper">
                <i class="nav-logo"></i>
                <button class="fast-composer"><i class="fa fa-edit"></i></button>
                <ul class="nav-actions">
                    <li>
                        <button class="selected"><i class="fa fa-dashboard"></i></button>
                    </li>
                    <li>
                        <button><i class="fa fa-compass"></i></button>
                    </li>
                    <li>
                        <button><i class="fa fa-inbox"></i></button>
                    </li>
                    <li>
                        <button class="profile-button" @click="toggleTopMenu"><i class="fa fa-user"></i></button>
                    </li>
                </ul>
                <div class="search-wrapper">
                    <form action="@route('search')" method="GET" role="search" novalidate @submit.prevent="searchQuery">
                        <div class="search-field">
                            <input type="text" name="keyword" placeholder="搜索...">
                            <i class="search-icon"></i>
                        </div>
                    </form>
                </div>
                <div class="search-popover"></div>
            </div>
        </nav>
        <section class="dashboard-container">
            <div class="blogs-container">
                <section class="left-column">
                    <nav class="blog-wrap new-blog-container" id="new-blog">
                        <div class="blog-selections">
                            <div class="selection">
                                <button class="post-text">
                                    <i class="fa fa-font"></i>
                                    <span>文字</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-photo">
                                    <i class="fa fa-photo"></i>
                                    <span>图片</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-link">
                                    <i class="fa fa-link"></i>
                                    <span>链接</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-audio">
                                    <i class="fa fa-headphones"></i>
                                    <span>音乐</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-video">
                                    <i class="fa fa-video-camera"></i>
                                    <span>视频</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-hashtag">
                                    <i class="fa fa-hashtag"></i>
                                    <span>话题</span>
                                </button>
                            </div>
                            <div class="selection">
                                <button class="post-checkin">
                                    <i class="fa fa-map-marker"></i>
                                    <span>签到</span>
                                </button>
                            </div>
                        </div>
                        <div class="blog-avatar">
                            <a href="#">
                                <img src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}">
                            </a>
                        </div>
                    </nav>
                    <div class="blogs-list">
                        @each('dashboard.partials.blog-item', $blogs, 'blog')
                    </div>
                </section>
                <section class="right-column">
                    <aside class="widget recommended-users widget--fixed" widget-fixed>
                        <div class="widget-heading">
                            <span>推荐用户</span>
                        </div>
                        <div class="widget-content-wrap">
                            <div class="widget-content">
                                <ol class="users-list">
                                    @forelse($recommended_users as $user)
                                        <li class="user-item">
                                            <a href="#">
                                                <span class="user-name big">{{ $user->name }}</span>
                                                <span class="user-name small">{{ $user->username }}</span>
                                                <div class="avatar">
                                                    <img src="{{ $user->avatarUrl }}" alt="{{ $user->name }}">
                                                </div>
                                            </a>
                                            <button class="follow-button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="no-result">

                                        </li>
                                    @endforelse
                                </ol>
                                <a href="#" class="more">查看更多...</a>
                            </div>
                        </div>
                    </aside>
                </section>
            </div>
        </section>
        <footer class="dashboard-footer">
            <div class="footer-inner">
                <span class="copyright">&copy; {{ date('Y') }} - @site('siteTitle')</span>
                <a href="#">About</a>
                <a href="#">Apps</a>
                <a href="#">Sponsor</a>
            </div>
        </footer>
    </div>
@endsection

@push('scripts.footer')
<script src="/assets/js/pages/dashboard.js"></script>
@endpush