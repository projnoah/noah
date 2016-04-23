<div class="footer" style="margin: 0 0 2.5em;text-align: center;">
    <div class="full">
        <p>&copy; {{ date('Y') }} - @site('siteTitle').</p>
        <small>All rights reserved.</small>
        <br>
        <small>@site('description')</small>
    </div>
    <div class="full">
        <small class="left no-reply" style="text-align: left;color: #bbbbbb;text-align: center;">@trans('emails.no-reply')</small>
    </div>
    <div class="row" style="display: flex;justify-content: center;align-items: center;margin: .8em 0;">
        <ul style="list-style: none;margin: .5em 0;padding: 0;">
            <li style="display: inline;"><a href="#" style="font-size: .75em;">@trans('emails.unsubscribe')</a></li>
        </ul>
    </div>
</div>