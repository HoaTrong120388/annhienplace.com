<!--- Sidemenu -->
<div id="sidebar-menu">
    <ul>
        <li class="text-muted menu-title">Hệ thống</li>
        <li>
            <a  class="waves-effect" href="{{ URL::route('admin.dashboard') }}">
                <i class="mdi mdi-view-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect @if (isset($nav_main) && $nav_main == 'setting')subdrop @endif">
                <i class="mdi mdi-account-circle"></i>
                <span> Quản lý tài khoản </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" @if (isset($nav_main) && $nav_main == 'setting') style="display:block;" @endif>
                {{-- <li class="@if (isset($nav_sub) && $nav_sub == 'setting-index') active @endif"><a href="{{ URL::route('admin.user.info') }}">Thông tin tài khoản</a></li> --}}
                <li class="@if (isset($nav_sub) && $nav_sub == 'setting-config') active @endif"><a href="{{ URL::route('admin.taikhoan.giaodich') }}">Lịch sử giao dịch</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect @if (isset($nav_main) && $nav_main == 'setting')subdrop @endif">
                <i class="mdi mdi-card-bulleted-outline"></i>
                <span> Quản lý dịch vụ </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" @if (isset($nav_main) && $nav_main == 'setting') style="display:block;" @endif>
                <li class="@if (isset($nav_sub) && $nav_sub == 'setting-index') active @endif"><a href="{{ URL::route('admin.napthe.index') }}">Nạp thẻ</a></li>
                {{-- <li class="@if (isset($nav_sub) && $nav_sub == 'setting-config') active @endif"><a href="{{ URL::route('admin.ruttien.index') }}">Rút tiên</a></li> --}}
            </ul>
        </li>
        
        @if (FCommon::checkPermissions('admin.user.list'))
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect  @if (isset($nav_main) && $nav_main == 'user')subdrop @endif">
                <i class="mdi mdi-account-circle"></i>
                <span> Tài Khoản </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" style="@if (isset($nav_main) && $nav_main == 'user') display:block @endif">
                <li class="@if (isset($nav_sub) && $nav_sub == 'user-list') active @endif"><a href="{{ URL::route('admin.user.list') }}">Quản lý</a></li>
                @if (FCommon::checkPermissions('admin.group.index'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'user-group') active @endif"><a href="{{ URL::route('admin.group.index') }}">Nhóm</a></li>
                @endif
                @if (FCommon::checkPermissions('admin.permissions.index'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'user-permissions') active @endif"><a href="{{ URL::route('admin.permissions.index') }}">Quyền</a></li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.setting.index'))
        <li class="has_sub">
            <a href="javascript:void(0);" class="waves-effect @if (isset($nav_main) && $nav_main == 'setting')subdrop @endif">
                <i class="mdi mdi-settings"></i>
                <span> Cài Đặt </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="list-unstyled" @if (isset($nav_main) && $nav_main == 'setting') style="display:block;" @endif>
                @if (FCommon::checkPermissions('admin.setting.index'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'setting-index') active @endif"><a href="{{ URL::route('admin.setting.index') }}">Thông tin công ty</a></li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.config'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'setting-config') active @endif"><a href="{{ URL::route('admin.setting.config') }}">Cấu hình</a></li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.seo'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'setting-seo') active @endif"><a href="{{ URL::route('admin.setting.seo') }}">Tối ưu seo</a></li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.language'))
                    <li class="@if (isset($nav_sub) && $nav_sub == 'setting-language') active @endif"><a href="{{ URL::route('admin.setting.language', ['file'=>'common']) }}">Ngôn ngữ</a></li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
    <div class="clearfix"></div>
</div>