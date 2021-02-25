<li>
    <a href="{{ route('admin.dashboard') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'dashboard') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
        <div class="side-menu__title"> Dashboard </div>
    </a>
</li>
@if (FCommon::checkPermissions('admin.page.index'))
<li>
    <a href="{{ route('admin.page.index') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'page') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
        <div class="side-menu__title"> Page </div>
    </a>
</li>
@endif
@if (FCommon::checkPermissions('admin.post.index'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'post') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="box"></i></div>
        <div class="side-menu__title"> Sản phẩm <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'post') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.post.index'))
        <li>
            <a href="{{ route('admin.post.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'post-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Sản Phẩm </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.catalog.index'))
        <li>
            <a href="{{ route('admin.catalog.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalog-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Danh Mục </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif
@if (FCommon::checkPermissions('admin.service.index'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'service') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="globe"></i></div>
        <div class="side-menu__title"> Dịch vụ <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'service') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.service.index'))
        <li>
            <a href="{{ route('admin.service.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'service-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Bài viết </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.catalogservice.index'))
        <li>
            <a href="{{ route('admin.catalogservice.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalogservice-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Danh mục </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif
@if (FCommon::checkPermissions('admin.news.index'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'news') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="coffee"></i></div>
        <div class="side-menu__title"> Tin tức <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'news') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.news.index'))
        <li>
            <a href="{{ route('admin.news.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'news-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Bài viết </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.catalognews.index'))
        <li>
            <a href="{{ route('admin.catalognews.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalognews-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Danh mục </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif


@if (FCommon::checkPermissions('admin.folder.index'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'folder') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="book"></i></div>
        <div class="side-menu__title"> Catalog <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'folder') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.folder.index'))
        <li>
            <a href="{{ route('admin.folder.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'folder-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Catalog </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.catalogfolder.index'))
        <li>
            <a href="{{ route('admin.catalogfolder.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'catalogfolder-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Danh mục </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif

@if (FCommon::checkPermissions('admin.media.index'))
<li>
    <a href="{{ route('admin.media.index') }}" class="side-menu @if (isset($nav_main) && $nav_main == 'media') {{$tagPcNav}}menu--active @endif"">
        <div class="side-menu__icon"> <i data-feather="image"></i> </div>
        <div class="side-menu__title"> Hình ảnh </div>
    </a>
</li>
@endif
<li class="side-nav__devider my-6"></li>
@if (FCommon::checkPermissions('admin.contact.index'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'contact') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="inbox"></i></div>
        <div class="side-menu__title"> Đăng ký <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'contact') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.contact.index'))
        <li>
            <a href="{{ route('admin.contact.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'contact-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Liên hệ </div>
            </a>
        </li>
        @endif
    </ul>
</li>
@endif
@if (FCommon::checkPermissions('admin.comment.index'))
<li>
    <a href="{{ route('admin.comment.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'comment-index') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="thumbs-up"></i> </div>
        <div class="side-menu__title"> Đánh Giá </div>
    </a>
</li>
@endif
<li class="side-nav__devider my-6"></li>
@if (FCommon::checkPermissions('admin.user.list'))
<li>
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'user') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="users"></i></div>
        <div class="side-menu__title"> Account <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'user') side-menu__sub-open @endif">
        <li>
            <a href="{{ route('admin.user.list') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-list') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Manage </div>
            </a>
        </li>
        @if (FCommon::checkPermissions('admin.group.index'))
        <li>
            <a href="{{ route('admin.group.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-group') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Group </div>
            </a>
        </li>
        @endif

        @if (FCommon::checkPermissions('adminmaster'))
        <li>
            <a href="{{ route('admin.permissions.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'user-permissions') {{$tagPcNav}}menu--active @endif">
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
    <a href="javascript:;" class="side-menu @if (isset($nav_main) && $nav_main == 'setting') {{$tagPcNav}}menu--active @endif">
        <div class="side-menu__icon"> <i data-feather="layout"></i> </div>
        <div class="side-menu__title"> Setting <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
    </a>
    <ul class="@if (isset($nav_main) && $nav_main == 'setting') side-menu__sub-open @endif">
        @if (FCommon::checkPermissions('admin.setting.index'))
        <li>
            <a href="{{ route('admin.setting.index') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-index') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Thông tin công ty </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.setting.config'))
        <li>
            <a href="{{ route('admin.setting.config') }}" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-config') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Cấu hình </div>
            </a>
        </li>
        @endif
        @if (FCommon::checkPermissions('admin.setting.language'))
        <li>
            <a href="javascript:void(0);" class="side-menu @if (isset($nav_sub) && $nav_sub == 'setting-language') {{$tagPcNav}}menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title"> Ngôn ngữ  <i data-feather="chevron-down" class="side-menu__sub-icon"></i></div>
            </a>
            <ul  class="@if (isset($nav_sub) && $nav_sub == 'setting-language') side-menu__sub-open @endif">
                <li>
                    <a href="{{ route('admin.setting.language', ['file'=>'common']) }}" class="side-menu @if (isset($file_name) && $file_name == 'common') {{$tagPcNav}}menu--active @endif">
                        <div class="side-menu__icon"> <i data-feather="zap"></i> </div>
                        <div class="side-menu__title">Common</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.setting.language', ['file'=>'landingpage']) }}" class="side-menu @if (isset($file_name) && $file_name == 'landingpage') {{$tagPcNav}}menu--active @endif">
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