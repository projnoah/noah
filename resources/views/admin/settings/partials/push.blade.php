<div class="panel panel-transparent">
    <div class="panel-heading">
        <h4 class="panel-title">@trans('views.admin.pages.settings.services.push.heading')</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <blockquote>
                <p>@trans('views.admin.pages.settings.services.push.tips')</p>
            </blockquote>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-transparent">
                    <div class="panel-heading facebook-colored-bg">
                        <h4 class="panel-title">Pusher</h4>
                    </div>
                    <div class="panel-body">
                        <form action="@route('admin.settings.save-push')" method="POST" class="form-horizontal" id="pusher-form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <div class="ios-switch switch-lg">
                                        <input type="checkbox" class="js-switch"
                                               name="on"{{ site('pusherOn') == '1' ? ' checked' : '' }}>
                                        &nbsp;@trans('views.admin.pages.settings.services.push.pusher.on')
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">App_ID</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="app_id" value="{{ env('PUSHER_APP_ID') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Key</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="key" value="{{ env('PUSHER_KEY') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Secret</label>
                                <div class="col-sm-9">
                                    <input class="form-control" value="{{ env('PUSHER_SECRET') }}" name="secret">
                                </div>
                            </div>
                            <div class="form-group">
                                <blockquote>
                                    <h4>@trans('views.admin.pages.settings.services.oauth.apply')</h4>
                                    <p><a href="https://dashboard.pusher.com/" target="_blank">https://dashboard.pusher.com/</a></p>
                                </blockquote>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-block">@trans('views.admin.pages.settings.update-button')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>