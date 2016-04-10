<article class="blog-wrap blog-item">
    <div class="blog-avatar">
        <a href="#">
            <img src="{{ $blog->user->avatarUrl }}" alt="{{ $blog->user->name }}">
        </a>
    </div>
    <div class="blog-content-wrap">
        <header class="blog-header">
            <div class="blog-status">
                <a href="#">{{ $blog->user->name }}</a>
                {{--<a href="#">Cali &nbsp;<span class="reblog-source"><i class="fa fa-retweet"></i>&nbsp;calicastle</span></a>--}}
            </div>
        </header>
        <section class="blog-content">
            <div class="blog-content-inner">
                <div class="blog-body">
                    {!! $blog->body !!}
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
                    <time datetime="{{ $blog->created_at->format('Y-m-d') }}">{{ $blog->created_at->diffForHumans() }}</time>
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
                        <i class="fa fa-comments-o"></i>
                        {{--<span>32</span>--}}
                    </button>
                    <button>
                        <i class="fa fa-retweet"></i>
                        {{--<span>99+</span>--}}
                    </button>
                    <button><i class="fa fa-thumbs-o-up"></i></button>
                </div>
            </div>
        </footer>
    </div>
    <div class="blog-share">
        <button class="share-toggle-button">
            <i class="share-icon fa fa-share-alt"></i>
        </button>
        <ul class="share-items">
            <li class="share-item">
                <a href="#" class="share-button facebook-colored-bg">
                    <i class="share-icon fa fa-facebook"></i>
                </a>
            </li>
            <li class="share-item">
                <a href="#" class="share-button twitter-colored-bg">
                    <i class="share-icon fa fa-twitter"></i>
                </a>
            </li>
            <li class="share-item">
                <a href="#" class="share-button wechat-colored-bg">
                    <i class="share-icon fa fa-wechat"></i>
                </a>
            </li>
            <li class="share-item">
                <a href="#" class="share-button weibo-colored-bg">
                    <i class="share-icon fa fa-weibo"></i>
                </a>
            </li>
        </ul>
    </div>
</article>