<?php
    if($is_mobile == 1){
        $link_banner = isset($setting_result['header_banner_mobile'])?$setting_result['header_banner_mobile']:'';
        if (isset($rs['more_info']->header_banner_mobile) && !empty($rs['more_info']->header_banner_mobile)) {
            $link_banner = $rs['more_info']->header_banner_mobile;
        }
    }else{
        $link_banner = isset($setting_result['header_banner_pc'])?$setting_result['header_banner_pc']:'';
        if (isset($rs['more_info']->header_banner_pc) && !empty($rs['more_info']->header_banner_pc)) {
            $link_banner = $rs['more_info']->header_banner_pc;
        }
    }
?>
<section class="main-header <?php if(isset($type) && $type == 'blog'): ?> main-header-blog <?php endif; ?>" style="background-image:url('<?php echo e(FCommon::cover_thumbnail($link_banner)); ?>')">
    <header>
        <div class="container <?php if(isset($type) && $type == 'blog'): ?> text-center <?php endif; ?>">
            <h1 class="h2 title"><?php echo e($header_title ?? ''); ?></h1>
            <?php echo $__env->make('frontend.common.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </header>
</section>