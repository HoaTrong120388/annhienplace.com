<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.common.header-content', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="blog <?php if($type_list == 'catalog'): ?> blog-block <?php endif; ?>">
        <div class="container">
            <div class="pre-header">
                <div>
                    <h2 class="h3 title">
                        <?php echo e($rs['title'] ?? ''); ?>

                        <?php if($arrResult->parentcategory()->count()): ?>
                            <br>
                            <small class="text-capitalize"><?php echo e($arrResult->parentcategory->title ?? ''); ?></small>
                        <?php endif; ?>
                    </h2>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $lstResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($type_list == 'catalog'): ?>
                        <?php echo $__env->make('frontend.content.news.item-catalog', ['item' =>  $item], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('frontend.content.catalog.item-catalog', ['item' =>  $item], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>