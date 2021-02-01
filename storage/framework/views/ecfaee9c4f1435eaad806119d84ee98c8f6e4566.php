<?php $__env->startSection('content'); ?>
<form action="<?php echo e(URL::route('admin.group.add')); ?>" method="post" enctype="multipart/form-data">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"><?php echo e($titlePage); ?></h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" id="btn-submit-form" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="<?php echo e($arrResult->id ?? ''); ?>">
            <input type="hidden" name="pageType" value="<?php echo e($pageType ?? 1); ?>">
            <input type="hidden" name="permissions" id="permissions" value="">
            <?php echo e(csrf_field()); ?>

        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 xxl:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div>
                                <label>Name</label>
                                <input type="text" class="input w-full border mt-2" placeholder="name" name="name" value="<?php echo e($arrResult->name ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 xxl:col-span-8">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Permission
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 xl:col-span-12">
                            <div id="checkTree">
                                <ul>
                                    <?php $__currentLoopData = $list_permissions_main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $controller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li id="<?php echo e($controller->id); ?>" data-jstree='{"opened":true}'>
                                            <?php echo e($controller->name); ?>

                                            <ul>
                                                <?php $__currentLoopData = $list_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($action->parent == $controller->id): ?>
                                                    <?php echo e($action->action); ?>

                                                        <?php if($action->action == 'index' || $action->action == 'list'): ?>
                                                            <li id="<?php echo e($action->id); ?>" data-jstree='{"icon":"mdi mdi-view-list" <?php if(in_array($action->id, $arrPermissions)): ?>, "selected":true <?php endif; ?> }'>
                                                        <?php elseif($action->action == 'add'): ?>
                                                            <li id="<?php echo e($action->id); ?>" data-jstree='{"icon":"mdi mdi-file-plus" <?php if(in_array($action->id, $arrPermissions)): ?>, "selected":true <?php endif; ?>}'>
                                                        <?php elseif($action->action == 'edit'): ?>
                                                            <li id="<?php echo e($action->id); ?>" data-jstree='{"icon":"mdi mdi-square-edit-outline" <?php if(in_array($action->id, $arrPermissions)): ?>, "selected":true <?php endif; ?>}'>
                                                        <?php elseif($action->action == 'delete'): ?>
                                                            <li id="<?php echo e($action->id); ?>" data-jstree='{"icon":"mdi mdi-trash-can-outline" <?php if(in_array($action->id, $arrPermissions)): ?>, "selected":true <?php endif; ?>}'>
                                                        <?php else: ?>
                                                            <li id="<?php echo e($action->id); ?>" data-jstree='{"type":"file" <?php if(in_array($action->id, $arrPermissions)): ?>, "selected":true <?php endif; ?>}'>
                                                        <?php endif; ?>
                                                            <?php echo e($action->name); ?>

                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('headerstyle'); ?>
<link href="<?php echo e(URL::asset('public/backend/dist/plugins/jstree/style.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footerjs'); ?>
<script src="<?php echo e(asset('public/backend/dist/plugins/jstree/jstree.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/backend/assets/pages/jquery.tree.js')); ?>"></script>
<script>
    $("#checkTree").on('changed.jstree', function (e, data){
        var selectedElmsIds1 = [];
        var selectedElms = $('#checkTree').jstree("get_selected", true);
        $.each(selectedElms, function() {
            selectedElmsIds1.push(this.id);
        });
        $("#permissions").val(selectedElmsIds1.toString());
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>