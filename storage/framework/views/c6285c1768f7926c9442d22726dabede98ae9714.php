<div class="col-sm-4">
    <article>
        <a href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>">
            <div class="image">
                <img src="<?php echo e(FCommon::cover_thumbnail($item->thumbnail, '360x470')); ?>" alt="<?php echo e($item->title); ?>" />
            </div>
            <div class="entry entry-block">
                <div class="date"><?php echo e(Carbon::parse($item->created_at)->format('Y-m-d')); ?></div>
                <div class="title">
                    <h2 class="h3"><?php echo e($item->title); ?></h2>
                </div>
                <div class="description">
                    <?php echo $item->summary; ?>

                </div>
            </div>
            <div class="show-more">
                <span class="btn btn-main btn-block">Xem chi tiết</span>
            </div>
        </a>
    </article>
</div>