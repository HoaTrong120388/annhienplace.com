<?php echo $__env->make('backend.layouts.header-login', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('backend.layouts.footer-login', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>