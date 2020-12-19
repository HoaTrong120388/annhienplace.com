<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> WLM<span class="font-medium"> Admin</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'dashboard') side-menu--active @endif"">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        @if (FCommon::checkPermissions('admin.page.index'))
        <li>
            <a href="{{ route('admin.page.index') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'page') side-menu--active @endif"">
                <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                <div class="side-menu__title"> Page </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.post.index'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'post') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="file-text"></i></div>
                <div class="side-menu__title"> Dịch vụ <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'post') side-menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.post.index'))
                <li>
                    <a href="{{ route('admin.post.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'post-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Bài Viết </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.catalog.index'))
                <li>
                    <a href="{{ route('admin.catalog.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalog-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Danh Mục </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.news.index'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'news') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="coffee"></i></div>
                <div class="side-menu__title"> Tin tức <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'news') side-menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.news.index'))
                <li>
                    <a href="{{ route('admin.news.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'news-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Bài viết </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.catalognews.index'))
                <li>
                    <a href="{{ route('admin.catalognews.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalognews-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Danh mục </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.image.index'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'libary') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="folder"></i></div>
                <div class="side-menu__title"> Thư viện <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'image') side-menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.image.index'))
                <li>
                    <a href="{{ route('admin.image.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'image-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Hình ảnh </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.video.index'))
                <li>
                    <a href="{{ route('admin.video.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'video-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Video </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.customer.index'))
        <li>
            <a href="{{ route('admin.customer.index') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'customer') side-menu--active @endif"">
                <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                <div class="side-menu__title"> Khách hàng </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.media.index'))
        <li>
            <a href="{{ route('admin.media.index') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'media') side-menu--active @endif"">
                <div class="side-menu__icon"> <i data-feather="image"></i> </div>
                <div class="side-menu__title"> Hình ảnh </div>
            </a>
        </li>
        @endif
        <li class="side-nav__devider my-6"></li>
        @if (FCommon::checkPermissions('admin.contact.index'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'contact') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="inbox"></i></div>
                <div class="side-menu__title"> Đăng ký <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'contact') side-menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.contact.index'))
                <li>
                    <a href="{{ route('admin.contact.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'contact-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Liên hệ </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        <li class="side-nav__devider my-6"></li>
        @if (FCommon::checkPermissions('admin.user.list'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'user') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="users"></i></div>
                <div class="side-menu__title"> Account <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'user') side-menu__sub-open @endif">
                <li>
                    <a href="{{ route('admin.user.list') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-list') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Manage </div>
                    </a>
                </li>
                @if (FCommon::checkPermissions('admin.group.index'))
                <li>
                    <a href="{{ route('admin.group.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-group') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Group </div>
                    </a>
                </li>
                @endif

                @if (FCommon::checkPermissions('adminmaster'))
                <li>
                    <a href="{{ route('admin.permissions.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-permissions') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Permission </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.setting.index'))
        <li>
            <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'setting') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="layout"></i> </div>
                <div class="side-menu__title"> Setting <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="@if (isset($nav_main) && $nav_main == 'setting') side-menu__sub-open @endif">
                @if (FCommon::checkPermissions('admin.setting.index'))
                <li>
                    <a href="{{ route('admin.setting.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-index') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Thông tin công ty </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.config'))
                <li>
                    <a href="{{ route('admin.setting.config') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-config') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Cấu hình </div>
                    </a>
                </li>
                @endif
                @if (FCommon::checkPermissions('admin.setting.language'))
                <li>
                    <a href="javascript:void(0);" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-language') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Ngôn ngữ  <i data-feather="chevron-down" class="side-menu__sub-icon"></i></div>
                    </a>
                    <ul  class="@if (isset($nav_sub) && $nav_sub == 'setting-language') side-menu__sub-open @endif">
                        <li>
                            <a href="{{ route('admin.setting.language', ['file'=>'common']) }}" class="side-menu @if (isset($file_name) && $file_name == 'common') side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Common</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.setting.language', ['file'=>'landingpage']) }}" class="side-menu @if (isset($file_name) && $file_name == 'landingpage') side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                                <div class="side-menu__title">Langding Page</div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</nav>
<!-- END: Side Menu -->