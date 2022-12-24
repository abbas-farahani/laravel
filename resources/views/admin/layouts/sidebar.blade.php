<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('admin.') }}" class="nav-link {{ isMenuItemActive( 'admin.' ) }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>پیشخوان</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ isMenuItemActive( [ 'admin.users.index', 'admin.users.create', 'admin.users.edit', 'admin.permissions.index', 'admin.permissions.create', 'admin.permissions.edit', 'admin.roles.index', 'admin.roles.create', 'admin.roles.edit' ], 'menu-open' ) }}">
                        <a href="#" class="nav-link {{ isMenuItemActive( [ 'admin.users.index', 'admin.users.create', 'admin.users.edit', 'admin.permissions.index', 'admin.permissions.create', 'admin.permissions.edit', 'admin.roles.index', 'admin.roles.create', 'admin.roles.edit' ] ) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isMenuItemActive( 'admin.users.index' ) }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.create') }}" class="nav-link {{ isMenuItemActive( 'admin.users.create' ) }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>کاربر جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isMenuItemActive( ['admin.roles.create', 'admin.roles.edit', 'admin.roles.index'] ) }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>نقش کاربری</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isMenuItemActive( ['admin.permissions.create', 'admin.permissions.edit', 'admin.permissions.index'] ) }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>اجازه دسترسی</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link ">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                ویجت‌ها
                                 <span class="right badge badge-danger">جدید</span>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
