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
                    <a title="Adjust the meta title" data-toggle="tab" data-target="#meta-seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Seo </a>
                    <a title="Adjust the meta title" data-toggle="tab" data-target="#layout" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="trello" class="w-4 h-4 mr-2"></i> Layout </a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="content">
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Summary </div>
                            <div class="mt-5">
                                <textarea class="element-ckeditor-small" id="ckeditor_summary"  name="summary"><?php echo e($arrResult->summary ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Content </div>
                            <div class="mt-5">
                                <textarea class="element-ckeditor" id="ckeditor_content" name="content" ><?php echo e($arrResult->content ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"> <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Thumbnail </div>
                            <div class="mt-5 ">
                                <div class="border-2 border-gray-200 border-dashed mt-2">
                                    <input type="file" name="file_thumbnail" class="dropify" id="thumbnail" data-default-file="<?php if(isset($arrResult->thumbnail)): ?> <?php echo e(FCommon::cover_thumbnail($arrResult->thumbnail)); ?><?php endif; ?>"  />
                                    <input type="hidden" id="source_thumbnail" name="thumbnail" value="<?php echo e($arrResult->thumbnail ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="meta-seo">
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 xl:col-span-4">
                                    <label>Share Image</label>
                                    <div class="border-2 border-gray-200 border-dashed mt-2">
                                        <input type="file" name="file_seo_image" class="dropify" id="seo_image" data-default-file="<?php if(isset($arrResult->seo->image)): ?> <?php echo e(FCommon::cover_thumbnail($arrResult->seo->image)); ?><?php endif; ?>"  />
                                        <input type="hidden" id="source_seo_image" name="seo_image" value="<?php echo e($arrResult->seo->image ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-8">
                                    <div>
                                        <label>Title</label>
                                        <input type="text" class="input w-full border mt-2" name="seo_title" value="<?php echo e($arrResult->seo->title ?? ''); ?>">
                                    </div>
                                    <div class="mt-3">
                                        <label>Description</label>
                                        <textarea class="input w-full border mt-2" name="seo_description"><?php echo e($arrResult->seo->description ?? ''); ?></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label>Keyword</label>
                                        <input type="text" class="input w-full border mt-2" name="seo_keyword" value="<?php echo e($arrResult->seo->keyword ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="layout">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12">
                                <div>
                                    <label>Banner Header PC</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_header_banner_pc" class="dropify" id="header_banner_pc" data-default-file="<?php if(isset($arrResult->more_info->header_banner_pc)): ?> <?php echo e(FCommon::cover_thumbnail($arrResult->more_info->header_banner_pc)); ?><?php endif; ?>"  />
                                        <input type="hidden" id="source_header_banner_pc" name="header_banner_pc" value="<?php echo e($arrResult->more_info->header_banner_pc ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label>Banner Header Mobile</label>
                                    <div class="border-2 border-gray-200 border-dashed dz-clickable mt-2">
                                        <input type="file" name="file_header_banner_mobile" class="dropify" id="header_banner_mobile" data-default-file="<?php if(isset($arrResult->more_info->header_banner_mobile)): ?> <?php echo e(FCommon::cover_thumbnail($arrResult->more_info->header_banner_mobile)); ?><?php endif; ?>"  />
                                        <input type="hidden" id="source_header_banner_mobile" name="header_banner_mobile" value="<?php echo e($arrResult->more_info->header_banner_mobile ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
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
                    <label>Slug</label>
                    <input class="input w-full border mt-2" name="slug" value="<?php echo e($arrResult->slug ?? ''); ?>">
                </div>
                <div class="mt-3">
                    <label>Public Date</label>
                    <input class="datepicker input w-full border mt-2" data-single-mode="true" name="public_date" value="<?php echo e($arrResult->public_date ?? ''); ?>">
                </div>
                <div class="mt-3">
                    <label>Categories</label>
                    <div class="mt-2">
                        <select data-placeholder="Select categories" class="tail-select w-full" name="parent">
                            <option value="0" <?php if(isset($arrResult->parent) && $arrResult->parent == 0): ?> selected <?php endif; ?>>Không có</option>
                            <?php $__currentLoopData = $lst_catalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php if(isset($arrResult->parent) && $arrResult->parent == $cat->id): ?> selected <?php endif; ?> ><?php echo e($cat->title); ?></option>
                                <?php if(count($cat->subcategory)): ?>
                                    <?php echo $__env->make('common.item-select-catalog',['subcategories' => $cat->subcategory, 'level' => 1, 'selected' => isset($arrResult->parent)?$arrResult->parent:0], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php endif; ?>
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
                <div class="mt-3">
                    <label>Special</label>
                    <div class="mt-2">
                        <input class="input input--switch border" type="checkbox" name="special" <?php if(isset($arrResult->special) && $arrResult->special == 1): ?> checked <?php endif; ?>>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Layout</label>
                    <div class="mt-2">
                        <select data-placeholder="Select categories" class="tail-select w-full" name="template">
                            <option value="1" <?php if(isset($arrResult->more_info->template) && $arrResult->more_info->template == 1): ?> selected <?php endif; ?>>Default</option>
                            <option value="2" <?php if(isset($arrResult->more_info->template) && $arrResult->more_info->template == 2): ?> selected <?php endif; ?>>Full Page</option>
                        </select>
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