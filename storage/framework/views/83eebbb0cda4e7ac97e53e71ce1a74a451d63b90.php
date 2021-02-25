<section class="header-content">
    <div class="owl-slider">
        <?php if($home_slider->count()): ?>
            <?php $__currentLoopData = $home_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item" style="background-image:url('<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>')">
                <div class="box">
                    <div class="container">
                        <h2 class="title animated h1" data-animation="fadeInDown"><?php echo e($item->title); ?></h2>
                        <div class="animated" data-animation="fadeInUp">
                            <?php echo $item->summary; ?>

                        </div>
                        <div class="animated" data-animation="fadeInUp">
                            <a href="<?php echo e($item->link); ?>" target="_blank" class="btn btn-main" ><i class="icon icon-cart"></i> <?php echo e(__("common.button_txt_slider")); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>