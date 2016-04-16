<div class="footer">
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
        </ul>
    </div>
</div>