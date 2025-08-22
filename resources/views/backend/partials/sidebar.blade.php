<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <a href="{{ route('panel.dashboard.index') }}" class="b-brand text-primary">
                    <img src="{{ asset('backend/assets/img/favicon/Restable.svg') }}" class="img-fluid logo-lg"
                        alt="logo" width="140">
                </a>
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('panel/dashboard') ? 'active' : '' }}">
            <a href="{{ route('panel.dashboard.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>
        <li class="menu-item {{ request()->is('panel/menu*', 'panel/chef*', 'panel/event*') ? 'open' : '' }}">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Account Settings">Master</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('panel/menu*') ? 'active' : '' }}">
                    <a href="{{ route('panel.menu.index') }}" class="menu-link">
                        <div data-i18n="Account">Menu</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('panel/chef*') ? 'active' : '' }}">
                    <a href="{{ route('panel.chef.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Chef</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('panel/event*') ? 'active' : '' }}">
                    <a href="{{ route('panel.event.index') }}" class="menu-link">
                        <div data-i18n="Connections">Event</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('panel/image*', 'panel/vidio*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div data-i18n="Account Settings">Galley</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('panel/image') ? 'active' : '' }}">
                    <a href="{{ route('panel.image.index') }}" class="menu-link">
                        <div data-i18n="Account">Image</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('panel/vidio*') ? 'active' : '' }}">
                    <a href="{{ route('panel.vidio.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Vidio</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('panel/transaction*') ? 'active' : '' }} ">
            <a href="{{ route('panel.transaction.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Analytics">Transaction</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('panel/review*') ? 'active' : '' }}">
            <a href="{{ route('panel.review.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-star"></i>
                <div data-i18n="Analytics">Reviews</div>
            </a>
        </li>
    </ul>
</aside>
