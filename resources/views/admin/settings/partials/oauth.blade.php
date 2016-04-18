<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading {{ strtolower($service) }}-colored-bg">
            <h4 class="panel-title" style="text-transform: capitalize"><i class="fa fa-{{ strtolower($service) }}"></i>&nbsp;{{ $service }}
            </h4>
        </div>
        <div class="panel-body">
            <form action="@route('admin.settings.save-oauth', ['service' => strtolower($service)])"
                  class="form-horizontal" method="POST" id="{{ strtolower($service) }}-oauth">
                {!! csrf_field() !!}
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <div class="ios-switch switch-lg">
                            <input type="checkbox" class="js-switch"
                                   name="on"{{ site(strtolower($service) . 'On') == '1' ? ' checked' : '' }}>
                            &nbsp;@trans('views.admin.pages.settings.services.oauth.on-text')
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $app_id }}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="app_id" autocomplete="off" value="{{ env(strtoupper($service) . '_ID') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ $app_secret }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="app_secret" autocomplete="off" value="{{ env(strtoupper($service) . '_SECRET') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@trans('views.admin.pages.settings.services.oauth.redirect')</label>
                    <div class="col-sm-9">
                        <input class="form-control"
                               value="@route('social-callback', ['service' => strtolower($service)])" name="redirect"
                               readonly>
                    </div>
                </div>
                <div class="form-group">
                    <blockquote>
                        <h4>@trans('views.admin.pages.settings.services.oauth.apply')</h4>
                        <p><a href="{{ $apply_url }}" target="_blank">{{ $apply_url }}</a></p>
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