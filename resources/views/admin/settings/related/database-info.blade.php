<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">@trans('views.admin.pages.settings.advanced.database.title')</h4>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="database-tables" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                <tr>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.name')</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.engine')</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.rows')</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.size')</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.collation')</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.total_count', ['count' => $tables->count()])</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.engine')</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.total_records', ['count' => $total_records])</th>
                    <th>{{ sprintf(($total_size / 1024) >= 1 ? "%.2f MB" : "%.2f KB", ($total_size / 1024) >= 1 ? $total_size / 1024.0 : $total_size) }}</th>
                    <th>@trans('views.admin.pages.settings.advanced.database.tables.collation')</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $table['name'] }}</td>
                            <td>{{ $table['status']['engine'] }}</td>
                            <td>{{ $table['status']['rows'] }}</td>
                            <td>{{ sprintf(($table['status']['size'] / 1024) >= 1 ? "%.2f MB" : "%.2f KB", ($table['status']['size'] / 1024) >= 1 ? $table['status']['size'] / 1024.0 : $table['status']['size']) }}</td>
                            <td>{{ $table['status']['collation'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>