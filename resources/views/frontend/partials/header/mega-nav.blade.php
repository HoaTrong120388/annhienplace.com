<header id="header" data-plugin-options="{'headerStickyEnabled': true, 'headerStickyBoxedEnable': true, 'headerStickyMobileEnable': true, 'headerStickyStart': 122, 'headerStickySetTop': '-122px', 'headerStickyLogoChange': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ route('frontend.home') }}">
                                <img alt="{{ $setting_result['main_seo_title'] }}" width="165" height="165" data-sticky-width="50" data-sticky-height="50" data-sticky-top="118" src="{{ asset('public/frontend/assets/images/logo.jpg') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row pt-3">
                        <nav class="header-nav-top">
                            <ul class="nav nav-pills">
                                @include('frontend.common.social-icon-share')
                                <li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-md-show">
                                    <a href="tel:{{ $setting_result['company_phone'] ?? '' }}"><i class="fa fa-phone"></i> {{ $setting_result['company_phone'] ?? '' }}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-row">
                        <ul class="header-extended-container-content d-flex align-items-center">
                            <li class="d-none d-md-inline-flex">
                                <div class="header-extended-container-content-text">
                                    <label class="text-uppercase">Email</label>
                                    <strong class="text-uppercase">{{ $setting_result['company_email'] ?? '' }}</strong>
                                </div>
                            </li>
                            <li>
                                <div class="header-extended-container-content-text">
                                    {!! $setting_result['company_work_time'] ?? '' !!}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="header-row">
                        <div class="header-nav">
                            <div class="header-nav-primary" data-dropdown-effect="default">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="headerNavPrimary">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('frontend.home') }}">
                                                {{ __('common.nav_home') }}
                                            </a>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="javascript:void(0)">
                                                {{ __('common.nav_product') }}
                                            </a>
                                            @if (isset($FrontendCatalog[1]))
                                            <ul class="dropdown-menu">
                                                @foreach ($FrontendCatalog[1] as $item)
                                                    <li @if ($item->subcategory()->count() > 0)class="dropdown-submenu"@endif>
                                                        <a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item->slug) }}">{{ $item->title }}</a>
                                                        @if ($item->subcategory()->count() > 0)
                                                        <ul class="dropdown-menu">
                                                            @foreach ($item->subcategory as $item_1)
                                                                <li><a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item_1->slug) }}">{{ $item_1->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                Dịch vụ 
                                            </a>
                                            @if (isset($FrontendCatalog[3]))
                                            <ul class="dropdown-menu">
                                                @foreach ($FrontendCatalog[3] as $item)
                                                    <li @if ($item->subcategory()->count() > 0)class="dropdown-submenu"@endif>
                                                        <a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item->slug) }}">{{ $item->title }}</a>
                                                        @if ($item->subcategory()->count() > 0)
                                                        <ul class="dropdown-menu">
                                                            @foreach ($item->subcategory as $item_1)
                                                                <li><a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item_1->slug) }}">{{ $item_1->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                Catalog
                                            </a>
                                            @if (isset($FrontendCatalog[4]))
                                            <ul class="dropdown-menu">
                                                @foreach ($FrontendCatalog[4] as $item)
                                                    <li @if ($item->subcategory()->count() > 0)class="dropdown-submenu"@endif>
                                                        <a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item->slug) }}">{{ $item->title }}</a>
                                                        @if ($item->subcategory()->count() > 0)
                                                        <ul class="dropdown-menu">
                                                            @foreach ($item->subcategory as $item_1)
                                                                <li><a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item_1->slug) }}">{{ $item_1->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                Blog
                                            </a>
                                            @if (isset($FrontendCatalog[2]))
                                            <ul class="dropdown-menu">
                                                @foreach ($FrontendCatalog[2] as $item)
                                                    <li @if ($item->subcategory()->count() > 0)class="dropdown-submenu"@endif>
                                                        <a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item->slug) }}">{{ $item->title }}</a>
                                                        @if ($item->subcategory()->count() > 0)
                                                        <ul class="dropdown-menu">
                                                            @foreach ($item->subcategory as $item_1)
                                                                <li><a class="dropdown-item" href="{{ route("frontend.catalog.detail", $item_1->slug) }}">{{ $item_1->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="{{ route("frontend.contact") }}">
                                                Liên hệ
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="hamburger-btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-primary nav">
                                <span class="hamburger">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <span class="close">
                                    <span></span>
                                    <span></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>