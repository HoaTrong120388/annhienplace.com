<?php if(!empty($setting_result['social_fanpage'])): ?>
<li class="nav-item nav-item-animated-icons d-none d-md-block">
    <a href="<?php echo e($setting_result['social_fanpage'] or ''); ?>">
        <i class="fa fa-facebook"></i>
        <?php if(isset($name)): ?> Facebook <?php endif; ?>
    </a>
</li>
<?php endif; ?>
<?php if(!empty($setting_result['social_twitter'])): ?>
<li class="nav-item nav-item-animated-icons d-none d-md-block">
    <a class="nav-link pl-0" href="<?php echo e($setting_result['social_twitter'] or ''); ?>">
        <i class="fa fa-twitter"></i>
        <?php if(isset($name)): ?> Twitter <?php endif; ?>
    </a>
</li>
<?php endif; ?>
<?php if(!empty($setting_result['social_linkedin'])): ?>
<li class="nav-item nav-item-animated-icons d-none d-md-block">
    <a class="nav-link pl-0" href="<?php echo e($setting_result['social_linkedin'] or ''); ?>">
        <i class="fa fa-linkedin"></i>
        <?php if(isset($name)): ?> Linkedin <?php endif; ?>
    </a>
</li>
<?php endif; ?>
<?php if(!empty($setting_result['social_instagram'])): ?>
<li class="nav-item nav-item-animated-icons d-none d-md-block">
    <a class="nav-link pl-0" href="<?php echo e($setting_result['social_instagram'] or ''); ?>">
        <i class="fa fa-instagram"></i>
        <?php if(isset($name)): ?> Instagram <?php endif; ?>
    </a>
</li>
<?php endif; ?>
<?php if(!empty($setting_result['social_youtube'])): ?>
<li class="nav-item nav-item-animated-icons d-none d-md-block">
    <a class="nav-link pl-0" href="<?php echo e($setting_result['social_youtube'] or ''); ?>">
        <i class="fa fa-youtube"></i>
        <?php if(isset($name)): ?> Youtube <?php endif; ?>
    </a>
</li>
<?php endif; ?>