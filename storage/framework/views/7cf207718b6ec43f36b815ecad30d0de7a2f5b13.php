<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <base href="<?php echo e(asset('public/backend')); ?>/">
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="HOATANG">
        <title><?php echo e($titlePage); ?></title>
        <!-- BEGIN: CSS Assets-->
        <link href="<?php echo e(asset('public/backend/dist/plugins/toastr/toastr.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/all/plugin/jquery-confirm/jquery-confirm.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/backend/dist/plugins/fileuploads/css/dropify.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="dist/css/app.css" />

        <!-- END: CSS Assets-->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>

        <script>
            var path_public             = "<?php echo e(asset('public')); ?>";
            var website_domain          = "<?php echo e($setting_result['website_domain'] ?? ''); ?>";
            var website_domain_admin    = "<?php echo e($setting_result['website_domain_admin'] ?? ''); ?>";
            var website_domain_api      = "<?php echo e($setting_result['website_domain_api'] ?? ''); ?>";
        </script>
        <?php echo FCommon::minifycss('backend_theme'); ?>

        <?php echo $__env->yieldContent('headerstyle'); ?>
    </head>
    <!-- END: Head -->
    <body class="app">