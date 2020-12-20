<?php if(isset($breadcrumb)): ?>
    <span class="header-breadcrumb">
        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->last): ?>
                <?php echo e($brea['title']); ?>

            <?php else: ?>
                <a href="<?php echo e($brea['link']); ?>"><?php echo e($brea['title']); ?></a> / 
            <?php endif; ?>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </span>
<?php endif; ?>