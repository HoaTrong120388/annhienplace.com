<!-- ========================  Blog Block ======================== -->
<section class="blog blog-block">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo __('common.home_service_title'); ?>

                </div>
            </div>
        </header>
        <div class="row">
            <?php $__currentLoopData = $home_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.content.service.item-service', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="<?php echo e(route("frontend.service.all")); ?>" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>