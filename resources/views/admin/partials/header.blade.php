<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="{{ route('dashboard') }}">
                    <h4 class="fw-bolder">SAFIRI</h4>
                </a>
            </div>
            <div class="dark-logo-wrapper">
                <a href="{{ route('dashboard') }}">
                    <h4 class="fw-bolder">SAFIRI</h4>
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"> </i></div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <form class="form-inline search-form">
                        <div class="search-bg"><i class="fa fa-search"></i>
                            <input class="form-control-plaintext" placeholder="Search here....." aria-label="Search">
                        </div>
                    </form>
                    <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li><a class="text-dark" href="#!" onclick="toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li>
                    <div class="mode"><i class="fas fa-moon"></i></div>
                </li>
                <li class="onhover-dropdown p-0">
                    <a href="{{ route('logout') }}" class="btn btn-primary-light"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>{{ __('Sign Out') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
