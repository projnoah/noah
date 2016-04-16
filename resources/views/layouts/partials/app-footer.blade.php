<footer class="dashboard-footer">
    <div class="footer-inner">
        <span class="copyright">&copy; {{ date('Y') }} - @site('siteTitle')</span>
        <a href="#">About</a>
        <a href="#">Apps</a>
        <a href="#">Sponsor</a>
    </div>
    @if(site('icp') != '' && !is_null(site('icp')))
    <div class="row">
        <div class="icp">
            <small>{{ site('icp') }}</small>
        </div>
    </div>
    @endif
</footer>