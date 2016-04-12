<form id="setup-form" class="fs-form fs-form-full" autocomplete="off" method="post" action="@route('install', compact('step'))">
    {!! csrf_field() !!}
    <ol class="fs-fields">
        <li>
            <label class="fs-field-label fs-anim-upper" for="admin_username" data-info="@trans('views.installation.inputs.admin_username_tip')">@trans('views.installation.inputs.admin_username')</label>
            <input class="fs-anim-lower" name="admin_username" type="text" placeholder="admin" value="{{ old('admin_username') }}" autofocus required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="admin_email" data-info="@trans('views.installation.inputs.admin_email_tip')">
                @trans('views.installation.inputs.admin_email')
            </label>
            <input class="fs-anim-lower" name="admin_email" type="email" placeholder="admin@admin.com" value="{{ old('admin_email') ?: '' }}" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="admin_password" data-info="@trans('views.installation.inputs.admin_password_tip')">@trans('views.installation.inputs.admin_password')</label>
            <input type="password" class="fs-anim-lower" name="admin_password" required/>
        </li>
    </ol>
    <button class="fs-submit" type="submit">@trans('views.installation.confirm')</button>
</form>