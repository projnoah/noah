<div class="page-footer">
    <div class="col-xs-5">
        <p class="no-s">{{ date('Y') }} &copy; @site('siteTitle').</p>
        <a href="{{ Noah::getHomeUrl() }}" style="text-decoration: none;"><b class="powered">Powered by Project Noah</b></a>
    </div>
    <div class="col-xs-5 text-right" style="line-height: 41px;">
        <small>
            @trans('views.admin.footer.current-version'): {{ Noah::getCurrentVersion() }}
            @if(Noah::isBeta())
                <span class="beta text-danger">Beta</span>
            @endif
        </small>
    </div>
</div>