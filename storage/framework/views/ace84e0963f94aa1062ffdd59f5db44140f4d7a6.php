<!-- ========================  Products widget ======================== -->
<section class="products">
    <div class="container">
        <!-- === header title === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo __('common.home_product_title'); ?>

                </div>
            </div>
        </header>
        <div class="row">
            <?php $__currentLoopData = $home_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.content.product.item-product', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="wrapper-more">
            <a href="<?php echo e(route('frontend.product.all')); ?>" class="btn btn-main">Xem thêm</a>
        </div>
    </div> <!--/container-->
</section>