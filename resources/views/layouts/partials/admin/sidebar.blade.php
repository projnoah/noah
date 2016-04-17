<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">
            <div class="sidebar-profile">
                <a href="javascript:void(0);" id="profile-menu-link">
                    <div class="sidebar-profile-image">
                        <img :src="User.avatarUrl" class="img-circle img-responsive" :alt="User.name">
                    </div>
                    <div class="sidebar-profile-details">
                        <span>@{{ User.name }}<br><small>@{{ User.email }}</small></span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu accordion-menu">
            <li class="{{ request()->is(substr(route('admin.dashboard', [], false), 1)) ? 'active' : '' }}">
                <a href="@route('admin.dashboard', [], false)" class="waves-effect waves-button" data-pjax>
                    <span class="menu-icon icon-speedometer"></span>
                    <p>@trans('views.admin.titles.dashboard')</p>
                </a>
            </li>
            <li class="droplink{{ request()->is(substr(route('admin.users.index', [], false), 1) . '*') ? ' active' : '' }}">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon icon-user"></span><p>@trans('views.admin.titles.users.main')</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="@route('admin.users.index', [], false)" data-pjax>@trans('views.admin.titles.users.sub.profile')</a></li>
                </ul>
            </li>
            <li class="droplink">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon icon-support"></span><p>@trans('views.admin.titles.data-center.main')</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="#">Something</a></li>
                </ul>
            </li>
            <li class="droplink{{ request()->is(substr(route('admin.settings.general', [], false), 1) . '*') ? ' active' : '' }}">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon icon-equalizer"></span><p>@trans('views.admin.titles.settings.main')</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="@route('admin.settings.general')" data-pjax>@trans('views.admin.titles.settings.sub.general')</a></li>
                    <li class="droplink">
                        <a href="#" class="waves-effect waves-button">
                            <p>@trans('views.admin.titles.settings.sub.advanced.main')</p>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="@route('admin.settings.advanced.index', [], false)" data-pjax>@trans('views.admin.titles.settings.sub.advanced.develop')</a></li>
                            <li><a href="@route('admin.settings.advanced.database', [], false)" data-pjax>@trans('views.admin.titles.settings.sub.advanced.database')</a></li>
                            <li><a href="@route('admin.settings.advanced.cache', [], false)" data-pjax>@trans('views.admin.titles.settings.sub.advanced.cache')</a></li>
                        </ul>
                    </li>
                    <li><a href="@route('admin.settings.display', [], false)" data-pjax>@trans('views.admin.titles.settings.sub.display')</a></li>
                    <li><a href="@route('admin.settings.services', [], false)" data-pjax>@trans('views.admin.titles.settings.sub.services')</a></li>
                </ul>
            </li>
            @stack('sidebar-menu')
        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->