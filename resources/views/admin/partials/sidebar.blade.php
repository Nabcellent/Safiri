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
                <span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
            </li>
            <li>
                <span>2 year</span>
                <p>Experince</p>
            </li>
            <li>
                <span><span class="counter">95.2</span>k</span>
                <p>Follower</p>
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
                        <a class="nav-link menu-title active" href="javascript:void(0)"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content" style="display: block;">
                            <li><a href="{{ route('admin.dashboard') }}" class="active">Default</a></li>
                            <li><a href="dashboard/dashboard-02.html">Ecommerce</a></li>
                        </ul>
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
                            <li><a href="{{ route('admin.destinations.index') }}">Grid</a></li>
                            <li><a href="ecommerce/list-products.html">List</a></li>
                            <li><a href="ecommerce/product-page.html">Product page</a></li>
                            <li><a href="ecommerce/payment-details.html">Payment Details</a></li>
                            <li><a href="ecommerce/order-history.html">Order History</a></li>
                            <li><a href="ecommerce/invoice-template.html">Invoice</a></li>
                            <li><a href="ecommerce/cart.html">Cart</a></li>
                            <li><a href="ecommerce/checkout.html">Checkout</a></li>
                            <li><a href="ecommerce/pricing.html">Pricing</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i
                                data-feather="mail"></i><span>Email</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="email/email_inbox.html">Mail Inbox</a></li>
                            <li><a href="email/email_read.html">Read mail</a></li>
                            <li><a href="email/email_compose.html">Compose</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="chat.html"><i
                                data-feather="message-circle"></i><span>Chat</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="contacts.html"><i data-feather="list"></i><span>Contacts</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav " href="calendar-basic.html">
                            <i data-feather="calendar"></i><span>Calender </span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)"><i data-feather="users"></i><span>Users</span></a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="users/user-profile.html">Users Profile</a></li>
                            <li><a href="users/edit-profile.html">Users Edit</a></li>
                            <li><a href="users/user-cards.html">Users Cards</a></li>
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
                    <li class="dropdown">
                        <a class="nav-link menu-title " href="javascript:void(0)">
                            <i data-feather="image"></i>
                            <span>Gallery</span>
                        </a>
                        <ul class="nav-submenu menu-content" style="display: none;">
                            <li><a href="gallery.html">Gallery Grid</a></li>
                            <li><a href="gallery/gallery-with-description.html">Gallery Grid Desc</a></li>
                            <li><a href="gallery/gallery-masonry.html">Masonry Gallery</a></li>
                            <li><a href="gallery/masonry-gallery-with-disc.html">Masonry with Desc</a></li>
                            <li><a href="gallery/gallery-hover.html">Hover Effects</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="faq.html">
                            <i data-feather="help-circle"></i><span>FAQ</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link menu-title link-nav " href="knowledgebase.html">
                            <i data-feather="database"></i><span>Knowledgebase</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
