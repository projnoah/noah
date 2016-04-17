<div class="panel panel-transparent">
    <div class="panel-body">
        <div class="clearfix m-b-md text-center well">
            <p>@trans('views.admin.pages.settings.services.email.tips')</p>
        </div>
        <div class="clearfix">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="@route('admin.settings.save-email')" method="POST" id="email-form">
                            {!! csrf_field() !!}
                            <div class="form-group text-center">
                                <div class="ios-switch switch-md">
                                    <input type="checkbox" name="on" class="js-switch"{{ site('smtpEmailOn') == '1' ? ' checked' : '' }}>
                                    &nbsp;@trans('views.admin.pages.settings.services.email.on')
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mail_driver">@trans('views.admin.pages.settings.services.email.mail_driver')</label>
                                <select name="mail_driver" id="driver-select" class="form-control" style="width: 100%;">
                                    <option value="smtp"{{ env('MAIL_DRIVER') === 'smtp' || is_null(env('MAIL_DRIVER')) ? ' selected' : '' }}>SMTP</option>
                                    <option value="mailgun"{{ env('MAIL_DRIVER') === 'mailgun' ? ' selected' : '' }}>Mailgun</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mail_host">@trans('views.admin.pages.settings.services.email.mail_host')</label>
                                <input type="text" name="mail_host" value="{{ env('MAIL_HOST') }}" class="form-control" placeholder="@trans('views.admin.pages.settings.services.email.mail_host-placeholder')">
                            </div>
                            <div class="form-group">
                                <label for="mail_port">@trans('views.admin.pages.settings.services.email.mail_port')</label>
                                <input type="number" name="mail_port" value="{{ env('MAIL_PORT') }}" class="form-control" placeholder="@trans('views.admin.pages.settings.services.email.mail_port-placeholder')">
                            </div>
                            <div class="form-group">
                                <label for="mail_username">@trans('views.admin.pages.settings.services.email.mail_username')</label>
                                <p class="form-control-static">{{ env('MAIL_USERNAME') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="mail_password">@trans('views.admin.pages.settings.services.email.mail_password')</label>
                                <input type="password" name="mail_password" value="{{ env('MAIL_PASSWORD') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mail_encryption">@trans('views.admin.pages.settings.services.email.mail_encryption')</label>
                                <select name="mail_encryption" id="encryption-select" class="form-control" style="width: 100%;">
                                    <option value="tsl"{{ env('MAIL_ENCRYPTION') === 'tsl' ? ' selected' : '' }}>TSL</option>
                                    <option value="ssl"{{ env('MAIL_ENCRYPTION') === 'ssl' ? ' selected' : '' }}>SSL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary btn-block">
                                    @trans('views.admin.pages.settings.update-button')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row text-center m-b-md">
                    <div class="panel panel-transparent">
                        <div class="panel-heading">
                            <h3 class="panel-title">@trans('views.admin.pages.settings.services.email.test-heading')</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="well">
                                <p>@trans('views.admin.pages.settings.services.email.test-tip')</p>
                            </div>
                            <form action="@route('admin.settings.send-test', [], false)" method="POST" id="test-sender" class="no-ajax">
                                {!! csrf_field() !!}
                                <input type="email" class="form-control input-rounded p-v-md text-center" name="email" send-test placeholder="@trans('views.admin.pages.settings.services.email.test-placeholder')">
                                <input type="submit" hidden>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="send">
                        <div class="send-indicator">
                            <div class="send-indicator-dot"></div>
                            <div class="send-indicator-dot"></div>
                            <div class="send-indicator-dot"></div>
                            <div class="send-indicator-dot"></div>
                        </div>
                        <button class="send-button">
                            <div class="sent-bg"></div>
                            <i class="fa fa-send send-icon"></i>
                            <i class="fa fa-check sent-icon"></i>
                            <i class="fa fa-times failed-icon"></i>
                        </button>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="800">
                        <defs>
                            <filter id="goo">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
                            </filter>
                            <filter id="goo-no-comp">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                            </filter>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>