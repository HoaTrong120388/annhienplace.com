<?php if(isset($breadcrumb) && is_array($breadcrumb)): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('frontend.home')); ?>"><span class="icon icon-home"></span></a></li>
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->last): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($brea['title'] ?? ''); ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?php echo e($brea['link'] ?? ''); ?>"><?php echo e($brea['title'] ?? ''); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
<?php endif; ?>