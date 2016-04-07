<footer>
    <div class="full">
        <p>&copy; {{ date('Y') }} - @site('siteTitle').</p>
        <small>All rights reserved.</small>
        <br>
        <small>@site('description')</small>
    </div>
    <div class="full">
        <small class="left no-reply">@trans('emails.no-reply')</small>
    </div>
    <div class="row">
        <ul>
            <li><a href="#">@trans('emails.unsubscribe')</a></li>
            <li><a href="#">你猜</a></li>
            <li><a href="#">你猜</a></li>
        </ul>
    </div>
    {{--<div class="row">--}}
    {{--<small>Powered by <a href="http://projnoah.com"><span class="powered">Project Noah</span></a></small>--}}
    {{--</div>--}}
</footer>