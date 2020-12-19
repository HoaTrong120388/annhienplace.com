<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{ URL::route('admin.dashboard') }}" class="menu @if (isset($nav_main) && $nav_main == 'dashboard') menu--active @endif"">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu @if (isset($nav_main) && $nav_main == 'taikhoan') menu--active @endif">
                <div class="menu__icon"> <i data-feather="trello"></i> </div>
                <div class="menu__title"> Quản lý tài khoản <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'taikhoan') menu__sub-open @endif">
                <li>
                    <a href="{{ URL::route('admin.taikhoan.giaodich') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'lichsugiaodich') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Lịch sử giao dịch </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="menu @if (isset($nav_main) && $nav_main == 'dichvu') menu--active @endif">
                <div class="menu__icon"> <i data-feather="box"></i> </div>
                <div class="menu__title"> Quản lý dịch vụ <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'dichvu') menu__sub-open @endif">
                <li>
                    <a href="{{ URL::route('admin.napthe.index') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'napthe') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Nạp thẻ </div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav__devider my-6"></li>
        @if (FCommon::checkPermissions('admin.user.list'))
        <li>
            <a href="javascript:;" class="menu @if (isset($nav_main) && $nav_main == 'user') menu--active @endif">
                <div class="menu__icon"> <i data-feather="users"></i></div>
                <div class="menu__title"> Account <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'user') menu__sub-open @endif">
                <li>
                    <a href="{{ URL::route('admin.user.list') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'user-list') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="users"></i> </div>
                        <div class="menu__title"> Manage </div>
                    </a>
                </li>
                @if (FCommon::checkPermissions('admin.group.index'))
                <li>
                    <a href="{{ URL::route('admin.group.index') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'user-group') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Group </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.group.index'))
                <li>
                    <a href="{{ URL::route('admin.permissions.index') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'user-permissions') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Permission </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.setting.index'))
        <li>
            <a href="javascript:;" class="menu @if (isset($nav_main) && $nav_main == 'setting') menu--active @endif">
                <div class="menu__icon"> <i data-feather="layout"></i> </div>
                <div class="menu__title"> Setting <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'setting') menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.setting.index'))
                <li>
                    <a href="{{ URL::route('admin.setting.index') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'setting-index') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Thông tin công ty </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.index'))
                <li>
                    <a href="{{ URL::route('admin.setting.config') }}" class="menu @if (isset($nav_sub) && $nav_sub == 'setting-config') menu--active @endif">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> Cấu hình </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</div>
<!-- END: Mobile Menu -->