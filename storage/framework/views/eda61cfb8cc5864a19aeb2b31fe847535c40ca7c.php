<?php $__env->startSection('headerstyle'); ?>
<!-- Modal -->
<link href="<?php echo e(URL::asset('public/backend/assets/plugins/custombox/dist/custombox.min.css')); ?>" rel="stylesheet">
<!-- X-editable css -->
<link type="text/css" href="<?php echo e(URL::asset('public/backend/assets/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css')); ?>" rel="stylesheet">
<!-- Tablesaw css -->
<link href="<?php echo e(URL::asset('public/backend/assets/plugins/tablesaw/css/tablesaw.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="container-fluid">
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-20">
                <a href="javascript:void(0);" class="btn btn-custom waves-effect waves-light add-new-item">Thêm</a>
            </div>
            <h4 class="page-title"><?php echo e($page_title); ?></h4>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Manage</h4>
                <p class="text-muted font-14 m-b-20">
                    Quản lý thành viên
                </p>
                <table class="tablesaw table m-b-0 tablesaw-stack tablesaw-sortable" data-tablesaw-sortable data-tablesaw-sortable-switch>
                    <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Name</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Description</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Controller</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Action</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Router Name</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" width="100"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $list_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->description); ?></td>
                            <td><?php echo e($item->controller); ?></td>
                            <td><?php echo e($item->action); ?></td>
                            <td><?php echo e($item->routername); ?></td>
                            <td>
                                <a href="<?php echo e(URL::route('admin.permissions.delete', $item->id )); ?>" class="btn btn-danger waves-effect m-b-5 btn-sm">
                                    <i class="fa fa-trash m-r-5"></i> <span>Xóa</span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div id="frm-add-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add New</h4>
    <div class="custom-modal-text text-left">
        <form class="form-horizontal" action="#" id="frm-add">
            <div class="form-group">
                <label class="col-form-label">Parent</label>
                <select class="form-control" name="parent">
                    <option value="">Không có</option>
                    <?php $__currentLoopData = $list_permissions_main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label">Description</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label">Controller</label>
                <input type="text" name="controller" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label">Action</label>
                <input type="text" name="action" class="form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label">Router Name</label>
                <input type="text" name="routername" class="form-control">
            </div>

            <button type="button" class="btn btn-success waves-effect waves-light" id="btn-submit-frm-add">Lưu </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footerjs'); ?>
<script src="<?php echo e(URL::asset('public/backend/assets/plugins/custombox/dist/custombox.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/backend/assets/plugins/custombox/dist/legacy.min.js')); ?>"></script>
<!-- XEditable Plugin -->
<script src="<?php echo e(URL::asset('public/backend/assets/plugins/moment/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('public/backend/assets/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('public/backend/assets/pages/jquery.xeditable.js')); ?>"></script>
<!-- Tablesaw js -->
<script src="<?php echo e(URL::asset('public/backend/assets/plugins/tablesaw/js/tablesaw.js')); ?>"></script>
<script src="<?php echo e(URL::asset('public/backend/assets/plugins/tablesaw/js/tablesaw-init.js')); ?>"></script>



<script>
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
        '<button type="button" class="btn btn-light editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';

    $(".add-new-item").on('click', function () {
        Custombox.open({
            target: "#frm-add-modal",
            effect: "fadein",
            overlaySpeed: 200,
            overlayColor: "#36404a",
            overlayClose: false
        });
    });
    $("#btn-submit-frm-add").on('click', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var myForm = document.getElementById('frm-add');
        formData = new FormData(myForm);
        $.ajax({
            type: "POST",
            url: "<?php echo e(URL::route('admin.permissions.index')); ?>",
            data: formData,
            dataType: "Json",
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {                    
                if(response.status == 1){
                    toastr.success('Thông tin đã được lưu thành công.', 'Thành Công');
                    Custombox.close();
                    setTimeout(function(){location.reload();}, 1000);
                }else{
                    toastr.error(response.list_error, 'Thất bại');
                }
            }
        });     
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>