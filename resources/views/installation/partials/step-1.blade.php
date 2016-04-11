<form id="setup-form" class="fs-form fs-form-full" autocomplete="off" method="post" action="@route('install', ['step' => 1])">
    {!! csrf_field() !!}
    <ol class="fs-fields">
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_host" data-info="@trans('views.installation.inputs.db_host_tip')">@trans('views.installation.inputs.db_host')</label>
            <input class="fs-anim-lower" id="q1" name="db_host" type="text" placeholder="localhost" value="localhost" autofocus required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_name" data-info="@trans('views.installation.inputs.db_name_tip')">
                @trans('views.installation.inputs.db_name')
            </label>
            <input class="fs-anim-lower" id="q2" name="db_name" type="text" placeholder="noah" value="noah" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_user">@trans('views.installation.inputs.db_user')</label>
            <input type="text" class="fs-anim-lower" id="q3" name="db_user" placeholder="root" value="root" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_password">@trans('views.installation.inputs.db_password')</label>
            <input type="password" class="fs-anim-lower" name="db_password" id="q4" required/>
        </li>
        <li>
            <label class="fs-field-label fs-anim-upper" for="db_prefix">@trans('views.installation.inputs.db_prefix')</label>
            <input type="text" class="fs-anim-lower" id="q5" name="db_prefix" placeholder="DB_">
        </li>
    </ol>
    <button class="fs-submit" type="submit">@trans('views.installation.confirm')</button>
</form>