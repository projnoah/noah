<div class="panel panel-transparent">
    <div class="panel-heading">
        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.heading')</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <blockquote>
                <p>@trans('views.admin.pages.settings.services.storage.tips')</p>
            </blockquote>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="@route('admin.settings.save-storage', [], false)" method="POST" id="storage-selector">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <select name="type" id="storage-type-select" class="form-control" style="width: 100%;">
                            @foreach(config('filesystems.disks') as $disk => $item)
                                <option value="{{ $disk }}"{{ config('filesystems.default') == $disk ? ' selected' : '' }}>
                                    @trans('views.admin.pages.settings.services.storage.disks.' . $disk)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit"
                                    class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix text-center">
                <div class="text-danger">
                    <p>@trans('views.admin.pages.settings.services.storage.warning')</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-transparent">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.disks.ftp')</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.save-disk', ['disk' => 'ftp'], false)" method="POST" id="ftp-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>@trans('views.admin.pages.settings.services.storage.ftp_host')</label>
                                <input type="text" name="ftp_host" class="form-control" value="{{ config('filesystems.disks.ftp.host') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('validation.attributes.username')</label>
                                <input type="text" name="username" class="form-control" value="{{ config('filesystems.disks.ftp.username') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('validation.attributes.password')</label>
                                <input type="password" name="password" class="form-control" value="{{ config('filesystems.disks.ftp.password') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.disks.s3')</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.save-disk', ['disk' => 's3'], false)" method="POST" id="s3-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" name="key" class="form-control" value="{{ config('filesystems.disks.s3.key') }}">
                            </div>
                            <div class="form-group">
                                <label>Secret</label>
                                <input type="password" name="secret" class="form-control" value="{{ config('filesystems.disks.s3.secret') }}">
                            </div>
                            <div class="form-group">
                                <label>Region</label>
                                <input type="text" name="region" class="form-control" value="{{ config('filesystems.disks.s3.region') }}">
                            </div>
                            <div class="form-group">
                                <label>Bucket</label>
                                <input type="text" name="bucket" class="form-control" value="{{ config('filesystems.disks.s3.bucket') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.disks.rackspace')</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.save-disk', ['disk' => 'rackspace'], false)" method="POST" id="rackspace-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>@trans('validation.attributes.username')</label>
                                <input type="text" name="username" class="form-control" value="{{ config('filesystems.disks.rackspace.username') }}">
                            </div>
                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" name="key" class="form-control" value="{{ config('filesystems.disks.rackspace.key') }}">
                            </div>
                            <div class="form-group">
                                <label>Container</label>
                                <input type="text" name="container" class="form-control" value="{{ config('filesystems.disks.rackspace.container') }}">
                            </div>
                            <div class="form-group">
                                <label>End Point</label>
                                <input type="text" name="endpoint" class="form-control" value="{{ config('filesystems.disks.rackspace.endpoint') }}">
                            </div>
                            <div class="form-group">
                                <label>Region</label>
                                <input type="text" name="region" class="form-control" value="{{ config('filesystems.disks.rackspace.region') }}">
                            </div>
                            <div class="form-group">
                                <label>URL Type</label>
                                <input type="text" name="url_type" class="form-control" value="{{ config('filesystems.disks.rackspace.url_type') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">@trans('views.admin.pages.settings.services.storage.disks.qiniu')</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.save-disk', ['disk' => 'qiniu'], false)" method="POST" id="qiniu-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>Access Key</label>
                                <input type="text" name="access_key" class="form-control" value="{{ config('filesystems.disks.qiniu.access_key') }}">
                            </div>
                            <div class="form-group">
                                <label>Secret Key</label>
                                <input type="password" name="secret_key" class="form-control" value="{{ config('filesystems.disks.qiniu.secret_key') }}">
                            </div>
                            <div class="form-group">
                                <label>Bucket</label>
                                <input type="text" name="bucket" class="form-control" value="{{ config('filesystems.disks.qiniu.bucket') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('views.admin.pages.settings.services.storage.qiniu_notify')</label>
                                <input type="text" name="notify_url" class="form-control" value="{{ config('filesystems.disks.qiniu.notify_url') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('views.admin.pages.settings.services.storage.qiniu_default')</label>
                                <input type="text" name="default" class="form-control" value="{{ config('filesystems.disks.qiniu.domains.default') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('views.admin.pages.settings.services.storage.qiniu_https')</label>
                                <input type="text" name="https" class="form-control" value="{{ config('filesystems.disks.qiniu.domains.https') }}">
                            </div>
                            <div class="form-group">
                                <label>@trans('views.admin.pages.settings.services.storage.qiniu_custom')</label>
                                <input type="text" name="custom" class="form-control" value="{{ config('filesystems.disks.qiniu.domains.custom') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-success btn-block">@trans('views.admin.pages.settings.update-button')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>