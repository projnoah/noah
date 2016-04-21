<div class="panel panel-white">
    <div class="panel-heading">
        <h4 class="panel-title">@trans('views.admin.pages.dashboard.uri')</h4>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
            @foreach(Stat::getTop('uri', 8) as $page)
                <li>
                    <b>{{ $page->name == '/' ? trans('views.admin.pages.dashboard.home') : $page->name }}</b>
                    <div class="text-primary pull-right">{{ $page->ratio }}%</div>
                    <div class="clearfix">
                        <div class="progress progress-xs bs-n m-t-xs m-b-xs">
                            <div class="progress-bar progress-bar" role="progressbar" style="width: {{ $page->ratio }}%"></div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>