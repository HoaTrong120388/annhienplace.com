<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="intro-x">
        <td><?php echo e($item->id); ?>;mk_catalog</td>
        <td><?php echo e($item->id); ?></td>
        <td title="<?php echo e($item->title); ?>"><?php for($i = 0; $i < $level; $i++): ?>| ------ <?php endfor; ?> <?php echo e(Str::limit($item->title, 100, '...')); ?></td>
        <td><input data-table="mk_catalog" data-id="<?php echo e($item->id); ?>" class="update_order" type="text" value="<?php echo e($item->order ?? ''); ?>"></td>
        <td><?php if($item->status == 1): ?>Active <?php else: ?> inActive <?php endif; ?></td>
        <td class="text-center">
            <div class="flex justify-center items-center">
                <a class="flex items-center mr-3" href="<?php echo e(URL::route("admin.$strControler.todo", ['id' => $item->id] )); ?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                <a class="flex items-center text-theme-6" onclick="confirm_delete('<?php echo e(URL::route("admin.$strControler.delete", ['id' => $item->id] )); ?>')" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
            </div>
        </td>
    </tr>
    <?php if(count($item->subcategory)): ?>
        <?php echo $__env->make('common.item-table-catalog',['subcategories' => $item->subcategory, 'level' => $level+1], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>