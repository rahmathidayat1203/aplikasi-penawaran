<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}"><a class="nav-link"
                            href="{{route('dashboard')}}">Dashboard</a></li>
                </ul>
            </li>
            @if (Auth::user()->hasRole('admin'))
            <li class="menu-header">Data</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('roles.index')}}">Role</a></li>
                    <li><a class="nav-link" href="{{route('users.index')}}">User</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </aside>
</div>
