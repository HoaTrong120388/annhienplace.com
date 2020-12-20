<link href="<?php echo e($setting_result['company_fav_icon'] ?? ''); ?>" rel="shortcut icon" type="image/x-icon" />
<title><?php echo e($titlePage_Seo or $setting_result['company_name']); ?></title>
<meta name="description" content="<?php echo e($keywordPage_Seo); ?>" />
<meta name="keywords" content="<?php echo e($descriptionPage_Seo); ?>">
<meta name="author" content="<?php echo e($setting_result['company_name'] ?? ''); ?>">

<?php if(isset($imagePage_Seo) && !empty($imagePage_Seo)): ?>
<meta property="og:image" content="<?php if(isset($arrResult['banner_form_register'])): ?> <?php echo e(FCommon::cover_thumbnail($arrResult['banner_form_register'])); ?><?php endif; ?>"/>
<meta content=1200 property=og:image:width>
<meta content=630 property=og:image:height>
<?php endif; ?>

<meta property="article:publisher" content="<?php echo e($setting_result['social_fanpage'] ?? ''); ?>" />
<meta property="article:author" content="<?php echo e($setting_result['social_fanpage'] ?? ''); ?>"/>
<meta property="og:site_name" content="<?php echo e($descriptionPage_Seo); ?>" />
<meta property="og:title" content="<?php echo e($titlePage_Seo); ?>" />
<meta property="og:description" content="<?php echo e($keywordPage_Seo); ?>" />
<meta property="og:updated_time" content="2019-10-01" />
<meta property="og:type" content="article" />
<meta property="og:og:locale" content="vi_vn" />