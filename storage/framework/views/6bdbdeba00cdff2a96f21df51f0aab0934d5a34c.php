<div class="col-sm-4 col-xs-6">
    <article>
        <a href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>">
            <div class="image" style="background-image:url('<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>')">
                <img src="<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>" alt="<?php echo e($item->title); ?>" width="360" />
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
        </a>
    </article>
</div>