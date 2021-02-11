
<section class="main-header <?php if(isset($type) && $type == 'blog'): ?> main-header-blog <?php endif; ?>" style="background-image:url('public/frontend/assets/images/bg-02.jpg')">
    <header>
        <div class="container <?php if(isset($type) && $type == 'blog'): ?> text-center <?php endif; ?>"">
            <h1 class="h2 title"><?php echo e($header_title ?? ''); ?></h1>
            <?php echo $__env->make('frontend.common.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </header>
</section>