<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.common.header-content', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="products">
        <div class="container">
            <header class="">
                <h3 class="h3 title"><?php echo e($rs['title'] ?? ''); ?></h3>
            </header>
            <div class="row">
                <!-- === product-items === -->
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <?php $__currentLoopData = $lstResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($type_list == 'catalog'): ?>
                                <?php echo $__env->make('frontend.content.product.item-catalog', ['item' =>  $item], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('frontend.content.product.item-product', ['item' =>  $item], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>