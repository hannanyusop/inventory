<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" >
                        <i class="metismenu-icon pe-7s-graph2"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-upload"></i>Stock Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.stock-receive.index') }}" >
                                <i class="metismenu-icon"></i> Receive Stock List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stock-transfer.index') }}" >
                                <i class="metismenu-icon"></i> Transfer Stock List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stock-report.index') }}" >
                                <i class="metismenu-icon"></i> Stock Report
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-ticket"></i>Product Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.item.index') }}" >
                                <i class="metismenu-icon"></i> List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.item.add') }}" >
                                <i class="metismenu-icon"></i> Add Product
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}" >
                                <i class="metismenu-icon"></i> Product Category
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.customer.index') }}" >
                        <i class="metismenu-icon pe-7s-users"></i>Customer
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.supplier.index') }}" >
                        <i class="metismenu-icon pe-7s-portfolio"></i>Supplier
                    </a>
                </li>
                @if ($logged_in_user->isAdmin())
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>User Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.auth.user.index') }}" >
                                <i class="metismenu-icon"></i> List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.auth.role.index') }}" >
                                <i class="metismenu-icon"></i> Role
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
