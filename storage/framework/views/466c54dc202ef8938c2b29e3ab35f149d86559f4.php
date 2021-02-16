<header id="header" data-plugin-options="{'headerStickyEnabled': true, 'headerStickyBoxedEnable': true, 'headerStickyMobileEnable': true, 'headerStickyStart': 100, 'headerStickySetTop': '-100px', 'headerStickyLogoChange': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="<?php echo e(route('frontend.home')); ?>">
                                <img alt="<?php echo e($setting_result['main_seo_title']); ?>" width="150" height="150" data-sticky-width="50" data-sticky-height="50" data-sticky-top="100" src="<?php echo e(FCommon::cover_thumbnail($setting_result['company_logo'])); ?>">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <nav class="header-nav-top">
                            <ul class="nav nav-pills">
                                <?php echo $__env->make('frontend.common.social-icon-page', ['class' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-md-show">
                                    <a href="tel:<?php echo e($setting_result['company_phone'] ?? ''); ?>"><i class="fa fa-phone"></i> <?php echo e($setting_result['company_phone'] ?? ''); ?></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-row">
                        <ul class="header-extended-container-content d-flex align-items-center">
                            <li class="d-none d-md-inline-flex">
                                <div class="header-extended-container-content-text">
                                    <label class="text-uppercase">Email</label>
                                    <strong class="text-uppercase"><?php echo e($setting_result['company_email'] ?? ''); ?></strong>
                                </div>
                            </li>
                            <li>
                                <div class="header-extended-container-content-text">
                                    <?php echo $setting_result['company_work_time'] ?? ''; ?>

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
                                            <a class="dropdown-item dropdown-toggle" href="<?php echo e(route('frontend.home')); ?>">
                                                <?php echo e(__('common.nav_home')); ?>

                                            </a>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="javascript:void(0)">
                                                <?php echo e(__('common.nav_product')); ?>

                                            </a>
                                            <?php if(isset($FrontendCatalog[1])): ?>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $FrontendCatalog[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li <?php if($item->subcategory()->count() > 0): ?>class="dropdown-submenu"<?php endif; ?>>
                                                        <a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                        <?php if($item->subcategory()->count() > 0): ?>
                                                        <ul class="dropdown-menu">
                                                            <?php $__currentLoopData = $item->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item_1->slug)); ?>"><?php echo e($item_1->title); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                <?php echo e(__('common.nav_service')); ?>

                                            </a>
                                            <?php if(isset($FrontendCatalog[3])): ?>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $FrontendCatalog[3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li <?php if($item->subcategory()->count() > 0): ?>class="dropdown-submenu"<?php endif; ?>>
                                                        <a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                        <?php if($item->subcategory()->count() > 0): ?>
                                                        <ul class="dropdown-menu">
                                                            <?php $__currentLoopData = $item->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item_1->slug)); ?>"><?php echo e($item_1->title); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                <?php echo e(__('common.nav_catalog')); ?>

                                            </a>
                                            <?php if(isset($FrontendCatalog[4])): ?>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $FrontendCatalog[4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li <?php if($item->subcategory()->count() > 0): ?>class="dropdown-submenu"<?php endif; ?>>
                                                        <a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                        <?php if($item->subcategory()->count() > 0): ?>
                                                        <ul class="dropdown-menu">
                                                            <?php $__currentLoopData = $item->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item_1->slug)); ?>"><?php echo e($item_1->title); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="#">
                                                <?php echo e(__('common.nav_blog')); ?>

                                            </a>
                                            <?php if(isset($FrontendCatalog[2])): ?>
                                            <ul class="dropdown-menu">
                                                <?php $__currentLoopData = $FrontendCatalog[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li <?php if($item->subcategory()->count() > 0): ?>class="dropdown-submenu"<?php endif; ?>>
                                                        <a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a>
                                                        <?php if($item->subcategory()->count() > 0): ?>
                                                        <ul class="dropdown-menu">
                                                            <?php $__currentLoopData = $item->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a class="dropdown-item" href="<?php echo e(route("frontend.catalog.detail", $item_1->slug)); ?>"><?php echo e($item_1->title); ?></a></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php endif; ?>
                                        </li>
                                        
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle " href="<?php echo e(route("frontend.contact")); ?>">
                                                <?php echo e(__('common.nav_contact')); ?>

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