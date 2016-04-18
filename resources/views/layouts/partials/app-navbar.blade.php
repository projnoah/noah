<nav class="dashboard-nav">
    <div class="nav-wrapper">
        <i class="nav-logo"></i>
        <button class="fast-composer"><i class="fa fa-edit"></i></button>
        <ul class="nav-actions">
            <li>
                <button class="selected"><i class="fa fa-dashboard"></i></button>
            </li>
            <li>
                <button><i class="fa fa-compass"></i></button>
            </li>
            <li>
                <button><i class="fa fa-inbox"></i></button>
            </li>
            <li>
                <button class="profile-button" @click="toggleTopMenu"><i class="fa fa-user"></i></button>
            </li>
            @check
            @if(Auth::user()->isAdmin())
            <li>
                <button @click="openPage(true, $event)" data-link="@route('admin.dashboard')"><i class="fa fa-sliders"></i></button>
            </li>
            @endif
            @endcheck
        </ul>
        <div class="search-wrapper">
            <form action="@route('search')" method="GET" role="search" novalidate @submit.prevent="searchQuery">
                <div class="search-field">
                    <input type="text" name="keyword" placeholder="搜索...">
                    <i class="search-icon"></i>
                </div>
            </form>
        </div>
        <div class="search-popover"></div>
    </div>
</nav>