<?php $__env->startSection('headerstyle'); ?>
<style>
    .pdfobject-container { height: 700px;}
    .pdfobject { border: 1px solid #666; }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(isset($page_about) && $page_about == 1): ?>
<section class="ele_bg_video">
    <div class="video-background">
        <div class="video-foreground">
            <video autoplay muted loop id="myVideo">
                <source src="http://edugo.vn/wp-content/uploads/2019/09/getfvid_10000000_403646313842445_5174170281876942748_n.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    
    
</section>
<?php else: ?>
<header class="inner-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <?php echo $__env->make('frontend.common.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <h1><?php echo e($arrResult['title'] or ''); ?></h1>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>
<section>
    <?php switch($arrResult['more_info']->template):
        case (2): ?>
            <?php echo $__env->make('frontend.content.detail.template.full-width', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php break; ?>

        <?php default: ?>
            <?php echo $__env->make('frontend.content.detail.template.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endswitch; ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>