<?php $__env->startSection('headerstyle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.setting.language')); ?>" method="post" enctype="multipart/form-data"data-single="true" action="/file-upload" >
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"><?php echo e($titlePage); ?></h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="<?php echo e($arrResult->id ?? 0); ?>">
            <input type="hidden" name="pageType" value="<?php echo e($pageType ?? 1); ?>">
            <?php echo e(csrf_field()); ?>

        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="all-content">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">Keyword</th>
                        <th class="whitespace-no-wrap">VI</th>
                        <th class="whitespace-no-wrap">EN</th>
                        <th class="whitespace-no-wrap" width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $all_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                        <tr class="intro-x">
                            <td><textarea name="key[]" class="input w-full border mt-2" rows="2"><?php echo e(isset($item[0])?$item[0]:''); ?></textarea></td>
                            <td><textarea name="vi[]" class="input w-full border mt-2" rows="2"><?php echo e(isset($item[1])?$item[1]:''); ?></textarea></td>
                            <td><textarea name="en[]" class="input w-full border mt-2" rows="2"><?php echo e(isset($item[2])?$item[2]:''); ?></textarea></td>
                            <td><a class="flex items-center text-theme-6 remove-item" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <button type="button" class="button text-white bg-theme-9 shadow-md flex items-center ml-2" id="btn-add-new"> <i class="w-4 h-4 mr-2" data-feather="plus"></i> Add More </button>
            <input type="hidden" name="file" value="<?php echo e($file_name ?? ''); ?>">
            <?php echo e(csrf_field()); ?>

        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script>
    $(document).ready(function() {
        var html_input = '<tr><td><textarea name="key[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><textarea name="vi[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><textarea name="en[]" class="input w-full border mt-2" rows="2"></textarea></td>\
                        <td><a class="flex items-center text-theme-6 remove-item" href="javascript:void(0);" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a></td></tr>';
        $("#btn-add-new").on('click', function () {
            $("#all-content tbody").append(html_input);
        })
    });
    $(document).on('click', '.remove-item', function () {
        $(this).closest("tr").remove();
    })
    $("#btn-submit-frm").on('click', function(){
        
        var myForm = document.getElementById('from-info');
        formData = new FormData(myForm);
        console.log(formData);
        
        $.ajax({
            type: "POST",
            url: "<?php echo e(URL::route('admin.setting.language')); ?>",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {                    
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    // setTimeout(function(){location.reload();}, 3000);
                }else{
                    toastr.error(response.msg, 'Thất bại');
                }
            }
        });     
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>