<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
</li>
<li class="side-menus {{ Request::is('users') ? 'active' : '' }}">
    <a class="nav-link" href="/users">
        <i class=" fas fa-users"></i><span>Users</span>
    </a>
</li>
<li class="side-menus {{ Request::is('Articles') ? 'active' : '' }}">
    <a class="nav-link" href="/articles">
        <i class=" fas fa-blog"></i><span>Articles</span>
    </a>
</li>
