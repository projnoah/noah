<div class="page-footer{{ site('poweredBy') != '0' ? '' : ' single-row' }}">
    <div class="col-xs-5">
        <p class="no-s">{{ date('Y') }} &copy; @{{ Site.title }}.</p>
        @if(site('poweredBy') != '0')
        <a href="{{ Noah::getHomeUrl() }}" style="text-decoration: none;"><b class="powered">Powered by Project Noah</b></a>
        @endif
    </div>
    <div class="col-xs-7 text-right" style="line-height: 41px;">
        <small id="noah-version">
            @trans('views.admin.footer.current-version'): {{ Noah::getCurrentVersion() }}
            @if(Noah::isBeta())
                <span class="beta badge badge-danger">Beta</span>
            @endif
            @if(Noah::getNewVersion() != noah_version())
                <span class="new-version badge badge-primary" id="new-version-footer">
                    <a href="@route('admin.settings.upgrade', [], false)" style="color: inherit;" data-pjax>{{ Noah::getNewVersion() }}</a>
                </span>
            @endif
        </small>
    </div>
</div>