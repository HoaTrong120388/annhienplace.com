<script src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/jquery.bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/jquery.owl.carousel.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/jquery.ion.rangeSlider.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/jquery.isotope.pkgd.js')); ?>"></script>
<script src="<?php echo e(asset('public/frontend/js/main.js')); ?>"></script>

<?php echo $__env->yieldContent('footerjs'); ?>
<?php echo FCommon::minifyjs('frontend_theme'); ?>

<?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('custom_js'); ?>