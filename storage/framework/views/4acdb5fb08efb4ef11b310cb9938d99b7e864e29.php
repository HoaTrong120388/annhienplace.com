<div class="col-md-4 col-xs-6">
    <article>
        <div class="figure-block">
            <div class="image">
                <a href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>">
                    <img src="<?php echo e(FCommon::cover_thumbnail($item->thumbnail)); ?>" alt="<?php echo e($item->title); ?>" width="360" />
                </a>
            </div>
            <div class="text">
                <h2 class="title h4"><a href="<?php echo e(route("frontend.catalog.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a></h2>
                
                <span class="description clearfix"><?php echo $item->summary; ?></span>
            </div>
        </div>
    </article>
</div>