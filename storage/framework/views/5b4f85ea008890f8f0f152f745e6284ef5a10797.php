<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <?php echo $__env->make('frontend.partials.header.header-meta-seo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('frontend.partials.header.header-style', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script>
        var path_public             = "<?php echo e(asset('public')); ?>";
        var path_upload             = "<?php echo e(asset('upload')); ?>";
        var website_domain          = "<?php echo e($setting_result['website_domain'] or ''); ?>";
    </script>
    <?php echo $__env->make('frontend.common.custom-code', ['type_include' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>

<body>
    <?php echo $__env->make('frontend.common.custom-code', ['type_include' => 2], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="page-loader"></div>
    <div class="wrapper">
        <?php echo $__env->make('frontend.partials.header.mega-nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>