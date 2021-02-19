<!-- ========================  Blog ======================== -->
<section class="blog">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo __('common.home_news_title'); ?>

                </div>
            </div>
        </header>
        <div class="row">
            <?php $__currentLoopData = $home_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-4">
                <article>
                    <a href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>">
                        <div class="image" style="background-image:url('<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>')">
                            <img src="<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>" alt="<?php echo e($item->title); ?>" />
                        </div>
                        <div class="entry entry-table">
                            <div class="date-wrapper">
                                <div class="date">
                                    <span><?php echo e(Carbon::parse($item->created_at)->format('M')); ?></span>
                                    <strong><?php echo e(Carbon::parse($item->created_at)->format('d')); ?></strong>
                                    <span><?php echo e(Carbon::parse($item->created_at)->format('Y')); ?></span>
                                </div>
                            </div>
                            <div class="title">
                                <h2 class="h5"><?php echo e($item->title); ?></h2>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem chi tiết</span>
                        </div>
                    </a>
                </article>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="<?php echo e(route("frontend.news.all")); ?>" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>