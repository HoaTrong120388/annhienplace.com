        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <script src="<?php echo e(asset('public/all/plugin/ckeditor/ckeditor.js')); ?>"></script>
        <script src="<?php echo e(asset('public/all/plugin/jquery-confirm/jquery-confirm.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/backend/dist/plugins/toastr/toastr.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/backend/dist/plugins/fileuploads/js/dropify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/backend/dist/plugins/jquery-tabledit/jquery.tabledit.min.js')); ?>"></script>
        <!-- END: JS Assets-->
        <?php echo FCommon::minifyjs('backend_theme'); ?>

        <?php echo $__env->yieldContent('footerjs'); ?>
        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
</html>