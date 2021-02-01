<?php $__env->startSection('content'); ?>
<form action="<?php echo e(URL::route("admin.$strControler.todo")); ?>" method="post" enctype="multipart/form-data"data-single="true" action="/file-upload" >
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto"><?php echo e($titlePage); ?></h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            
            <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> <i class="w-4 h-4 mr-2" data-feather="save"></i> Save </button>
            <input type="hidden" name="id" value="<?php echo e($arrResult->id ?? 0); ?>">
            <?php echo e(csrf_field()); ?>

        </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <input type="text" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" name="title" id="title" placeholder="Tiêu đề" value="<?php echo e($arrResult->title ?? ''); ?>">
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 dark:bg-dark-2 text-gray-600">
                    <a title="Fill in the article content" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Content </a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="content">
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Thumbnail </div>
                            <div class="mt-5 ">
                                <div class="border-2 border-gray-200 border-dashed mt-2">
                                    <input type="file" name="file_thumbnail" class="dropify" id="thumbnail" data-default-file="<?php if(isset($arrResult->thumbnail)): ?> <?php echo e(FCommon::cover_thumbnail($arrResult->thumbnail)); ?><?php endif; ?>"  />
                                    <input type="hidden" id="source_thumbnail" name="thumbnail" value="<?php echo e($arrResult->thumbnail ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label>Link</label>
                            <input type="text" class="input w-full border mt-2" name="link" value="<?php echo e($arrResult->link ?? ''); ?>">
                        </div>
                        <div class="mt-2">
                            <label>Content</label>
                            <textarea name="" id="" cols="30" rows="10"></textarea>
                            <input type="text" class="input w-full border mt-2" name="link" value="<?php echo e($arrResult->link ?? ''); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                <div class="mt-3">
                    <label>Categories</label>
                    <div class="mt-2">
                        <select data-placeholder="Select categories" class="tail-select w-full" name="parent">
                            <option value="0" <?php if(isset($arrResult->parent) && $arrResult->parent == 0): ?> selected <?php endif; ?>>Không có</option>
                            <?php $__currentLoopData = $lst_catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php if(isset($arrResult->parent) && $arrResult->parent == $key): ?> selected <?php endif; ?> ><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label>Published</label>
                    <div class="mt-2">
                        <input class="input input--switch border" type="checkbox" name="status" <?php if(isset($arrResult->status) && $arrResult->status == 1): ?> checked <?php endif; ?>>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
</form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('headerstyle'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>