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
        <div class="hidden md:block mx-auto text-gray-600"><?php echo e($str_show_record ?? ''); ?></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <form class="form-horizontal" action="" id="frm_filter_data" >
                    <input type="text" name="keyword" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..." autocomplete="off" value="<?php echo e($arrFilter['keyword'] ?? ''); ?>">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    <?php echo e(csrf_field()); ?>

                </form>
            </div>
        </div>


    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report mt-2" id="data_table">
            <thead>
                <tr>
                    <th></th>
                    <th class="whitespace-no-wrap" width="150">Created</th>
                    <th class="whitespace-no-wrap" width="150">Public</th>
                    <th class="whitespace-no-wrap">Title</th>
                    <th class="whitespace-no-wrap" width="100">Special</th>
                    <th class="whitespace-no-wrap" width="100">Status</th>
                    <th class="text-center whitespace-no-wrap" width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($arrResult) && count((array)$arrResult) > 0): ?>
                    <?php $__currentLoopData = $arrResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="intro-x">
                        <td><?php echo e($item->id); ?>;mk_post</td>
                        <td><?php echo e(Carbon::parse($item->created_at)->format('d-m-Y')); ?></td>
                        <td><?php echo e(Carbon::parse($item->public_date)->format('d-m-Y')); ?></td>
                        <td title="<?php echo e($item->title); ?>"><a target="_blank" href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>"><?php echo e(Str::limit($item->title, 100, '...')); ?></a></td>
                        <td><?php if($item->special == 1): ?>Active <?php else: ?> inActive <?php endif; ?></td>
                        <td><?php if($item->status == 1): ?>Active <?php else: ?> inActive <?php endif; ?></td>
                        <td class="text-center">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="<?php echo e(URL::route("admin.$strControler.todo", ['id' => $item->id] )); ?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6" onclick="confirm_delete('<?php echo e(URL::route("admin.$strControler.delete", ['id' => $item->id] )); ?>')" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h3>Không có dữ liệu phù hợp</h3>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <?php echo e($arrResult->links('pagination::admin')); ?>

    <!-- END: Pagination -->
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
        fnc_editTable('<?php echo e(route("admin.updatedata")); ?>', 5, 4);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>