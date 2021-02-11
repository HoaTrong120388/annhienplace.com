<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($subcategory->id); ?>" <?php if($selected == $subcategory->id): ?> selected <?php endif; ?> ><?php for($i = 0; $i < $level; $i++): ?>|--<?php endfor; ?> <?php echo e($subcategory->title); ?></option>
    <?php if(count($subcategory->subcategory)): ?>
        <?php echo $__env->make('common.item-select-catalog',['subcategories' => $subcategory->subcategory, 'level' => $level+1], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>