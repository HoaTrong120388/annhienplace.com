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
            <a href="index.html" class="logo"><img src="{{ asset('public/frontend/assets/images/logo.png') }}" alt="" /></a>
            <!-- Mobile toggle menu -->
            <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>
            <!-- Convertible menu (mobile/desktop)-->
            <div class="floating-menu">
                <!-- Mobile toggle menu trigger-->
                <div class="close-menu-wrapper">
                    <span class="close-menu"><i class="icon icon-cross"></i></span>
                </div>
                <ul>
                    <li><a href="{{ route("frontend.home") }}">Trang Chủ</a></li>
                    <li><a href="./shops">TPMS MÔ TÔ</a></li>
                    <li><a href="./shops">TPMS Ô TÔ</a></li>
                    <li><a href="./shops">TPMS XE KHÁC</a></li>
                    <li><a href="./shops">TIN TỨC</a></li>
                    <li><a href="./shops">LIÊN HỆ</a></li>
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