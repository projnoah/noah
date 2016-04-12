<form id="setup-form" class="fs-form fs-form-full" autocomplete="off" method="post" action="@route('install', compact('step'))">
    {!! csrf_field() !!}
    <ol class="fs-fields">
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_host" data-info="@trans('views.installation.inputs.db_host_tip')">@trans('views.installation.inputs.db_host')</label>
            <input class="fs-anim-lower" name="db_host" type="text" placeholder="localhost" value="localhost" autofocus required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_name" data-info="@trans('views.installation.inputs.db_name_tip')">
                @trans('views.installation.inputs.db_name')
            </label>
            <input class="fs-anim-lower" name="db_name" type="text" placeholder="noah" value="{{ old('db_name') ?: 'noah' }}" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_user">@trans('views.installation.inputs.db_user')</label>
            <input type="text" class="fs-anim-lower" name="db_user" placeholder="root" value="{{ old('db_user') ?: 'root' }}" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_password">@trans('views.installation.inputs.db_password')</label>
            <input type="password" class="fs-anim-lower" name="db_password" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_prefix">@trans('views.installation.inputs.db_prefix')</label>
            <input type="text" class="fs-anim-lower" name="db_prefix" placeholder="DB_" value="{{ old('db_prefix') }}">
        </li>
    </ol>
    <button class="fs-submit" type="submit">@trans('views.installation.confirm')</button>
</form>