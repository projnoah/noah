<div class="navbar">
    <div class="navbar-inner">
        <div class="sidebar-pusher">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="logo-box">
            <a href="@route('admin.dashboard')" class="logo-text"><span>@site('siteTitle')</span></a>
        </div><!-- Logo Box -->
        <div class="search-button">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
        </div>
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="icon-layers"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                            <i class="fa fa-cogs"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                            <form action="@route('admin.change-settings')" id="setting-changer"></form>
                            <li class="li-group">
                                <ul class="list-unstyled">
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.fixed-header')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right fixed-header-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.fixed-header', 'value', true) ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.fixed-sidebar')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right fixed-sidebar-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.fixed-sidebar') ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="li-group">
                                <ul class="list-unstyled">
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.horizontal-bar')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right horizontal-bar-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.horizontal-bar') ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.toggle-sidebar')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right toggle-sidebar-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.toggle-sidebar') ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.compact-menu')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right compact-menu-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.compact-menu') ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.hover-menu')
                                        <div class="ios-switch pull-right switch-md">
                                            <input type="checkbox" class="js-switch pull-right hover-menu-check" {{ Auth::user()->adminThemeSettingMeta('admin.theme.hover-menu') ? 'checked' : '' }}>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="li-group">
                                <ul class="list-unstyled">
                                    <li class="no-link" role="presentation">
                                        @trans('views.admin.navbar.settings.theme-color')
                                        <div class="color-switcher">
                                            <a class="color-box color-blue" href="?theme=blue" title="Blue Theme" data-css="blue" data-color="#12afcb"></a>
                                            <a class="color-box color-brown" href="?theme=brown" title="Brown Theme" data-css="brown" data-color="#A52A2A"></a>
                                            <a class="color-box color-green" href="?theme=green" title="Green Theme" data-css="green" data-color="#22baa0"></a>
                                            <a class="color-box color-red" href="?theme=red" title="Red Theme" data-css="red" data-color="#F25656"></a>
                                            <a class="color-box color-white" href="?theme=white" title="White Theme" data-css="white" data-color="#eee"></a>
                                            <a class="color-box color-purple" href="?theme=purple" title="Purple Theme" data-css="purple" data-color="#7a6fbe"></a>
                                            <a class="color-box color-yellow" href="?theme=yellow" title="Yellow Theme" data-css="yellow" data-color="#ee2"></a>
                                            <a class="color-box color-dark" href="?theme=dark" title="Dark Theme" data-css="dark" data-color="#34425A"></a>
                                            <a class="color-box color-pink" href="?theme=pink" title="Pink Theme" data-css="pink" data-color="#FB36AC"></a>
                                            <a class="color-box color-gray" href="?theme=gray" title="Gray Theme" data-css="gray" data-color="#d3d3d3"></a>
                                        </div>
                                        <form action="@route('admin.change-theme-color')" id="color-changer" class="hidden"></form>
                                    </li>
                                </ul>
                            </li>
                            <li class="no-link"><button class="btn btn-default reset-options">@trans('views.admin.navbar.settings.reset')</button></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">4</span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                            <li><p class="drop-title">You have 4 new  messages !</p></li>
                            <li class="dropdown-menu-list slimscroll messages">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Sandra Smith</p>
                                            <p class="msg-text">Hey ! I'm working on your project</p>
                                            <p class="msg-time">3 minutes ago</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Amily Lee</p>
                                            <p class="msg-text">Hi David !</p>
                                            <p class="msg-time">8 minutes ago</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Christopher Palmer</p>
                                            <p class="msg-text">See you soon !</p>
                                            <p class="msg-time">56 minutes ago</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Nick Doe</p>
                                            <p class="msg-text">Nice to meet you</p>
                                            <p class="msg-time">2 hours ago</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online on"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Sandra Smith</p>
                                            <p class="msg-text">Hey ! I'm working on your project</p>
                                            <p class="msg-time">5 hours ago</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="msg-img"><div class="online off"></div><img class="img-circle" src="{{ Auth::user()->avatarUrl }}" alt=""></div>
                                            <p class="msg-name">Amily Lee</p>
                                            <p class="msg-text">Hi David !</p>
                                            <p class="msg-time">9 hours ago</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right">3</span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                            <li><p class="drop-title">You have 3 pending tasks !</p></li>
                            <li class="dropdown-menu-list slimscroll tasks">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#">
                                            <div class="task-icon badge badge-success"><i class="icon-user"></i></div>
                                            <span class="badge badge-roundless badge-default pull-right">1min ago</span>
                                            <p class="task-details">New user registered.</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-icon badge badge-danger"><i class="icon-energy"></i></div>
                                            <span class="badge badge-roundless badge-default pull-right">24min ago</span>
                                            <p class="task-details">Database error.</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-icon badge badge-info"><i class="icon-heart"></i></div>
                                            <span class="badge badge-roundless badge-default pull-right">1h ago</span>
                                            <p class="task-details">Reached 24k likes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                            <span class="user-name">@{{ User.name }}<i class="fa fa-angle-down"></i></span>
                            <img class="img-circle avatar" :src="User.avatarUrl" width="40" height="40" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-list" role="menu">
                            <li role="presentation">
                                <a href="@route('admin.users.profile')" data-pjax>
                                    <i class="icon-user m-r-xs"></i>@trans('views.admin.titles.users.sub.profile')
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="inbox.html">
                                    <i class="icon-envelope"></i>Inbox
                                    <span class="badge badge-success pull-right">4</span>
                                </a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                            <li role="presentation"><a href="login.html"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="@route('exit')" class="log-out waves-effect waves-button waves-classic">
                            <span><i class="glyphicon glyphicon-off m-r-xs"></i>@trans('views.admin.navbar.logout')</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic" id="showRight">
                            <i class="fa fa-comments"></i>
                        </a>
                    </li>
                </ul><!-- Nav -->
            </div><!-- Top Menu -->
        </div>
    </div>
</div><!-- Navbar -->