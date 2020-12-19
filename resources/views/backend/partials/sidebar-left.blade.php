<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <img src="@if (!empty(Session::get('user_avatar')))
                {{ FCommon::cover_thumbnail(Session::get('user_avatar'), '80x80') }}
            @else
                {{ asset('public/backend/assets/images/users/avatar-5.jpg') }}
            @endif" alt="user-img" title="{{ Session::get('user_fullname') }}"class="rounded-circle img-thumbnail img-responsive">
                <div class="user-status online"><i class="mdi mdi-adjust"></i></div>
            </div>
            <!--<h5><a href="#">{{ Session::get('user_fullname') }}</a> </h5>-->
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('admin.user.info') }}">
                        <i class="mdi mdi-settings"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('admin.lockscreen') }}">
                        <i class="mdi mdi-lock"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('admin.logout') }}">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->
        @include('backend.partials.nav')
    </div>
</div>
<!-- Left Sidebar End -->