@extends('layouts.app')

@section('title', trans('views.dashboard.home.title'))

@section('app.content')
    <section class="dashboard-container">
        <div class="blogs-container">
            <section class="left-column">
                <nav class="blog-wrap new-blog-container" role="menu" id="new-blog">
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
                    {{-- Append form --}}
                    <div class="row">
                        <h3>@trans('views.unavailable.coming-soon')</h3>
                    </div>
                    <div class="blog-form blog-form--text hidden">
                        {{--<div class="blog-margin"></div>--}}
                        <div class="blog-container">
                            <div class="blog-container-inner">
                                <div class="blog-form-header clearfix">
                                    <div class="blog-controls">
                                        <div class="control left">
                                            <b>{{ Auth::user()->name }}</b>
                                        </div>
                                        <div class="control right">

                                        </div>
                                    </div>
                                </div>
                                <div class="blog-form-text-content">
                                    <div class="blog-form-title">

                                    </div>
                                    <div class="text-field">
                                        <div class="editor-wrapper">
                                            <div class="editor richtext" contenteditable="true">
                                                <p></p>
                                            </div>
                                            <div class="editor-placeholder">说点什么吧...</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-form-footer">
                                    <div class="blog-tag-editor"></div>
                                </div>
                                <div class="blog-form-bottom">
                                    <div class="blog-controls">
                                        <div class="control left">
                                            <button>关闭</button>
                                        </div>
                                        <div class="control right">
                                            <button>发布</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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