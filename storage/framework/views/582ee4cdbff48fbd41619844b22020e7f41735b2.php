<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<h2 class="intro-y text-lg font-medium mt-10">
    <?php echo e($titlePage); ?>

</h2>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <?php if(FCommon::checkPermissions('admin.user.add')): ?>
            <a href="<?php echo e(URL::route('admin.group.add')); ?>" data-toggle="modal" data-target="#header-footer-modal-preview" class="button text-white bg-theme-1 shadow-md mr-2">Add New</a>
        <?php endif; ?>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap" width="50px">#</th>
                    <th class="whitespace-no-wrap">Group</th>
                    <th class="text-center whitespace-no-wrap" width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($list_permission) && count((array)$list_permission) > 0): ?>
                    <?php $__currentLoopData = $list_permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="intro-x">
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="<?php echo e(URL::route('admin.group.permissions', $item->id )); ?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
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
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('headerstyle'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script>
    $(document).ready(function() {
        $(".change-password-modal").on('click', function () {
            $("#frm-update-password").trigger('reset');
            $("#user-id-modal").val($(this).data('id-user'));
        });
        $("#btn-submit-form-update-password").on('click', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = $("#frm-update-password").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo e(URL::route('admin.user.updatepassword')); ?>",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        show_noti('Thông tin đã được lưu thành công.', 'success');
                        $("#frm-update-password").trigger('reset');
                    } else {
                        show_noti(response.msg, 'danger');
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>