<div class="panel panel-white">
    <div class="panel-heading">
        <h4 class="panel-title">@trans('views.admin.pages.settings.advanced.develop.server-info')</h4>
    </div>
    <div class="panel-body">
        <div class="row m-b-xs clearfix">
            <div class="col-xs-4 text-right">@trans('views.admin.pages.settings.advanced.develop.noah-installed')</div>
            <div class="col-xs-8">
                <b>{{ $noah_installed_time->diffForHumans() }}</b>
            </div>
        </div>
        <div class="row m-b-xs clearfix">
            <div class="col-xs-4 text-right">@trans('views.admin.pages.settings.advanced.develop.php-ver')</div>
            <div class="col-xs-8">
                <b>{{ $php_version }}</b>
            </div>
        </div>
        <div class="row m-b-xs clearfix">
            <div class="col-xs-4 text-right">@trans('views.admin.pages.settings.advanced.develop.mysql-ver')</div>
            <div class="col-xs-8">
                <b>{{ $mysql_version }}</b>
            </div>
        </div>
        <div class="row m-b-xs clearfix">
            <div class="col-xs-4 text-right">@trans('views.admin.pages.settings.advanced.develop.os')</div>
            <div class="col-xs-8">
                <b>{{ $operating_system }}</b>
            </div>
        </div>
        <div class="row m-b-xs clearfix">
            <div class="col-xs-4 text-right">@trans('views.admin.pages.settings.advanced.develop.server-software')</div>
            <div class="col-xs-8">
                <b>{{ $server_software }}</b>
            </div>
        </div>
    </div>
</div>