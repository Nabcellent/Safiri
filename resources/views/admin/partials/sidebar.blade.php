<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a>
        <img class="img-90 rounded-circle" src="/images/admin/dashboard/1.png" alt=""/>
        @if(Auth::user()->created_at->isBetween(now()->subWeek(), now()))
            <div class="badge-bottom">
                <span class="badge badge-primary">New</span>
            </div>
        @endif
        <a href="user-profile.html"><h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->full_name }}</h6></a>
        <p class="mb-0 font-roboto">{{ isAdmin() ? isRed() ? '~Sir.' : 'Admin' : 'Human Resources Department' }}</p>
        <ul>
            <li>
                <span><span class="counter">{{ Auth::user()->bookings()->count() }}</span></span>
                <p>Bookings</p>
            </li>
            <li>
                <span>{{ Auth::user()->created_at->diffForHumans() }}</span>
                <p>Created</p>
            </li>
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    {{--==--==--==--==--==--==--==--==    GENESIS    ==--==--==--==--==--==--==--==--}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="{{ route('admin.dashboard') }}">
                            <i data-feather="bar-chart-2"></i><span>Dashboard</span></a>
                    </li>

                    {{--==--==--==--==--==--==--==--==    APPLICATIONS    ==--==--==--==--==--==--==--==--}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Applications</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="shopping-bag"></i><span>Destinations</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="{{ route('admin.destinations.index') }}">List</a></li>
                            <li><a href="{{ route('admin.destinations.api.index') }}">API</a></li>
                            <li><a href="{{ route('admin.destinations.create') }}">Create</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="{{ route('admin.bookings.index') }}">
                            <i data-feather="calendar"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="{{ route('admin.banners.index') }}">
                            <i data-feather="list"></i>
                            <span>Banners</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="users"></i><span>Users</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="{{ route('admin.users.index') }}">List</a></li>
                            {{--                            <li><a href="users/edit-profile.html">Create</a></li>--}}
                        </ul>
                    </li>

                    {{--==--==--==--==--==--==--==--==    MISCELLANEOUS    ==--==--==--==--==--==--==--==--}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Miscellaneous</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)">
                            <i data-feather="map"></i>
                            <span>Client Pages</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
                        </ul>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link menu-title link-nav " href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"></i><span>Leave</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
