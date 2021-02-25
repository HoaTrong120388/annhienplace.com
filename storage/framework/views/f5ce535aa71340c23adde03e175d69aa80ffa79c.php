<!-- ========================  Icons slider ======================== -->
<section class="owl-icons-wrapper owl-icons-frontpage">
    <!-- === header === -->
    <header class="d-none">
        <h2><?php echo __('common.home_slider_catalog'); ?></h2>
    </header>
    <div class="container">
        <div class="owl-icons">
            <?php $__currentLoopData = $home_catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>">
                <figure>
                    <span class="img-icon">
                        <img src="<?php echo e(FCommon::cover_thumbnail($item->icon)); ?>" alt="<?php echo e($item->title); ?>">
                    </span>
                    <figcaption><?php echo e($item->title); ?></figcaption>
                </figure>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> <!--/owl-icons-->
    </div> <!--/container-->
</section>