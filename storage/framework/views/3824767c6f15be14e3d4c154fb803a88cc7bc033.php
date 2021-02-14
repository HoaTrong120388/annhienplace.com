<!-- ========================  Stretcher widget ======================== -->
<section class="stretcher-wrapper">
    <!-- === stretcher header === -->
    <header class="hidden">
        <!--remove class 'hidden'' to show section header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo __('common.home_catalog_title'); ?>

                </div>
            </div>
        </div>
    </header>
    <!-- === stretcher === -->
    <ul class="stretcher">
        <?php $__currentLoopData = $home_catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->index < 4): ?>
            <li class="stretcher-item" style="background-image:url('<?php echo e(FCommon::cover_thumbnail($item->banner_home)); ?>');">
                <div class="stretcher-logo">
                    <div class="text">
                        <span class="img-icon">
                            <img src="<?php echo e(FCommon::cover_thumbnail($item->icon)); ?>" alt="<?php echo e($item->title); ?>">
                        </span>
                        <span class="text-intro"><?php echo e($item->title); ?></span>
                    </div>
                </div>
                <figure>
                    <h4><?php echo e($item->title); ?></h4>
                    <figcaption><?php echo e($item->summary); ?></figcaption>
                </figure>
                <a href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>">Chi tiết</a>
            </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="<?php echo e(route('frontend.product.all')); ?>"></a>
        </li>
    </ul>
</section>