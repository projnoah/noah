@extends('layouts.app')

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
                    <form action="@route('search')" method="GET" role="search" novalidate>
                        <div class="search-field">
                            <input type="text" name="keyword" placeholder="Search...">
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
                        @for($i = 0; $i <= 30; $i++)
                            <article class="blog-wrap blog-item">
                                <div class="blog-avatar">
                                    <a href="#">
                                        <img src="{{ \Noah\Avatar::defaultUrl() }}" alt="">
                                    </a>
                                </div>
                                <div class="blog-content-wrap">
                                    <header class="blog-header">
                                        <div class="blog-status">
                                            <a href="#">Cali &nbsp;<span class="reblog-source"><i class="fa fa-retweet"></i>&nbsp;whxitm</span></a>
                                        </div>
                                    </header>
                                    <section class="blog-content">
                                        <div class="blog-content-inner">
                                            <div class="blog-body">
                                                <h2>王海鑫是大SB!</h2>
                                                <p>王海鑫是大SB</p>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="blog-tags">
                                        <div class="blog-tags-inner">
                                            <a href="#">funny</a>
                                            <a href="#">lol</a>
                                            <a href="#">this shit is legit</a>
                                            <a href="#">OK</a>
                                        </div>
                                    </section>
                                    <footer class="blog-footer">
                                        <div class="blog-metas">
                                            <div class="blog-time">
                                                <time datetime="{{ \Carbon\Carbon::yesterday()->format('Y-m-d') }}">{{ \Carbon\Carbon::yesterday()->diffForHumans() }}</time>
                                            </div>
                                            <div class="blog-sent-from">
                                                <span>来自网页端</span>
                                            </div>
                                        </div>
                                        <div class="blog-actions">
                                            <div class="blog-actions-inner">
                                                <button>
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <button>
                                                    <i class="fa fa-send-o"></i>
                                                </button>
                                                <button>
                                                    <i class="fa fa-comment-o"></i>
                                                    <span>32</span>
                                                </button>
                                                <button><i class="fa fa-retweet"></i><span>99+</span></button>
                                                <button><i class="fa fa-heart-o"></i></button>
                                            </div>
                                        </div>
                                    </footer>
                                </div>
                            </article>
                        @endfor
                    </div>
                </section>
                <section class="right-column">
                    <div class="panel panel-primary">
                        <div class="panel-heading">什么鬼</div>
                        <div class="panel-body">
                            什么鬼!
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">什么鬼</div>
                        <div class="panel-body">
                            什么鬼!
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">什么鬼</div>
                        <div class="panel-body">
                            什么鬼!
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">什么鬼</div>
                        <div class="panel-body">
                            什么鬼!
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection