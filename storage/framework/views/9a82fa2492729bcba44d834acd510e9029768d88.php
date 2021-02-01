<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<h2 class="intro-y text-lg font-medium mt-10">
    <?php echo e($titlePage); ?>

</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <?php if(FCommon::checkPermissions("admin.$strControler.todo")): ?>
        <a href="<?php echo e(route("admin.$strControler.todo")); ?>" class="button text-white bg-theme-1 shadow-md mr-2">Add New</a>
        <?php endif; ?>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report mt-2" id="data_table">
            <thead>
                <tr>
                    <th></th>
                    <th class="whitespace-no-wrap" width="50">#</th>
                    <th class="whitespace-no-wrap">Title</th>
                    <th class="whitespace-no-wrap" width="100">Order</th>
                    <th class="whitespace-no-wrap" width="100">Status</th>
                    <th class="text-center whitespace-no-wrap" width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($arrResult) && count((array)$arrResult) > 0): ?>
                    <?php $__currentLoopData = $arrResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="intro-x">
                        <td><?php echo e($item->id); ?>;mk_catalog</td>
                        <td><?php echo e($item->id); ?></td>
                        <td title="<?php echo e($item->title); ?>"><?php echo e(Str::limit($item->title, 100, '...')); ?></td>
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
                        <?php echo $__env->make('common.item-table-catalog',['subcategories' => $item->subcategory, 'level' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h3>Không có dữ liệu phù hợp</h3>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="delete-confirmation-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('headerstyle'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script>
    $(document).ready(function() {
        fnc_editTable('<?php echo e(route("admin.updatedata")); ?>', 4);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>