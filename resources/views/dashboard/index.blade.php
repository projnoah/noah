@extends('layouts.app')

@section('title', trans('views.dashboard.home.title'))

@section('app.content')
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
@endsection

@push('scripts.footer')
<script src="/assets/js/pages/dashboard.js"></script>
@endpush