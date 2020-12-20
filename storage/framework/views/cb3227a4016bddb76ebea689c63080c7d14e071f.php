<nav class="navbar-fixed">
    <div class="container">
        <!-- ==========  Top navigation ========== -->
        <div class="navigation navigation-top clearfix">
            <ul>
                <!--add active class for current page-->
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="javascript:void(0);" class="open-search"><i class="icon icon-magnifier"></i></a></li>
            </ul>
        </div> <!--/navigation-top-->
        <!-- ==========  Main navigation ========== -->
        <div class="navigation navigation-main">
            <!-- Setup your logo here-->
            <a href="index.html" class="logo"><img src="<?php echo e(asset('public/frontend/assets/images/logo.jpg')); ?>" alt="" /></a>
            <!-- Mobile toggle menu -->
            <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>
            <!-- Convertible menu (mobile/desktop)-->
            <div class="floating-menu">
                <!-- Mobile toggle menu trigger-->
                <div class="close-menu-wrapper">
                    <span class="close-menu"><i class="icon icon-cross"></i></span>
                </div>
                <ul>
                    <li><a href="<?php echo e(route("frontend.home")); ?>">Trang Chủ</a></li>
                    <li>
                        <a href="san-pham">Sản phẩm <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown">
                            <div class="navbar-box">
                                <div class="box-2">
                                    <div class="box clearfix">
                                        <div class="row">
                                            <div class="clearfix">
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Catalory 1</li>
                                                        <li><a href="javascript:void(0);">Benches</a></li>
                                                        <li><a href="javascript:void(0);">Submenu <span class="label label-warning">New</span></a></li>
                                                        <li><a href="javascript:void(0);">Chaises</a></li>
                                                        <li><a href="javascript:void(0);">Recliners</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Catalory 2</li>
                                                        <li><a href="javascript:void(0);">Bockcases</a></li>
                                                        <li><a href="javascript:void(0);">Closets</a></li>
                                                        <li><a href="javascript:void(0);">Wardrobes</a></li>
                                                        <li><a href="javascript:void(0);">Dressers <span class="label label-success">Trending</span></a></li>
                                                        <li><a href="javascript:void(0);">Sideboards </a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Catalory 3</li>
                                                        <li><a href="javascript:void(0);">Consoles</a></li>
                                                        <li><a href="javascript:void(0);">Desks</a></li>
                                                        <li><a href="javascript:void(0);">Dining tables</a></li>
                                                        <li><a href="javascript:void(0);">Occasional tables</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--/box-->
                                </div> <!--/box-2-->
                            </div> <!--/navbar-box-->
                        </div> <!--/navbar-dropdown-->
                    </li>
                    <li>
                        <a href="dich-vu">Dịch vụ <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown">
                            <div class="navbar-box">
                                <div class="box-2">
                                    <div class="box clearfix">
                                        <div class="row">
                                            <div class="clearfix">
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Service 1</li>
                                                        <li><a href="javascript:void(0);">Benches</a></li>
                                                        <li><a href="javascript:void(0);">Submenu <span class="label label-warning">New</span></a></li>
                                                        <li><a href="javascript:void(0);">Chaises</a></li>
                                                        <li><a href="javascript:void(0);">Recliners</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Service 2</li>
                                                        <li><a href="javascript:void(0);">Bockcases</a></li>
                                                        <li><a href="javascript:void(0);">Closets</a></li>
                                                        <li><a href="javascript:void(0);">Wardrobes</a></li>
                                                        <li><a href="javascript:void(0);">Dressers <span class="label label-success">Trending</span></a></li>
                                                        <li><a href="javascript:void(0);">Sideboards </a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li class="label">Service 3</li>
                                                        <li><a href="javascript:void(0);">Consoles</a></li>
                                                        <li><a href="javascript:void(0);">Desks</a></li>
                                                        <li><a href="javascript:void(0);">Dining tables</a></li>
                                                        <li><a href="javascript:void(0);">Occasional tables</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--/box-->
                                </div> <!--/box-2-->
                            </div> <!--/navbar-box-->
                        </div> <!--/navbar-dropdown-->
                    </li>
                    
                    <li>
                        <a href="#">Catalog <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">

                                <!-- box-2 (without 'box-1', box-2 will be displayed as full width)-->

                                <div class="box-2">
                                    <div class="box clearfix">
                                        <ul>
                                            <li><a href="products-grid.html">Products grid</a></li>
                                            <li><a href="products-list.html">Products list</a></li>
                                            <li><a href="category.html">Products intro</a></li>
                                            <li><a href="products-topbar.html">Products topbar</a></li>
                                            <li><a href="product.html">Product overview</a></li>
                                        </ul>
                                    </div> <!--/box-->
                                </div> <!--/box-2-->
                            </div> <!--/navbar-box-->
                        </div> <!--/navbar-dropdown-->
                    </li>
                    <li><a href="./tin-tuc">TIN TỨC</a></li>
                    <li><a href="./lien-he.html">LIÊN HỆ</a></li>
                </ul>
            </div> <!--/floating-menu-->
        </div> <!--/navigation-main-->
        <!-- ==========  Search wrapper ========== -->
        <div class="search-wrapper">
            <!-- Search form -->
            <input class="form-control" placeholder="Search..." />
            <button class="btn btn-main btn-search">Go!</button>
            <!-- Search results - live search -->
            <div class="search-results">
                <div class="search-result-items">
                    <div class="title h4">Products <a href="#" class="btn btn-clean-dark btn-xs">View all</a></div>
                    <ul>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Green corner</span> <span class="category">Sofa</span></a></li>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Laura</span> <span class="category">Armchairs</span></a></li>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Nude</span> <span class="category">Dining tables</span></a></li>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Aurora</span> <span class="category">Nightstands</span></a></li>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Dining set</span> <span class="category">Kitchen</span></a></li>
                        <li><a href="#"><span class="id">42563</span> <span class="name">Seat chair</span> <span class="category">Bar sets</span></a></li>
                    </ul>
                </div> <!--/search-result-items-->
            </div> <!--/search-results-->
        </div>
    </div> <!--/container-->
</nav>