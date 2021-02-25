<?php if(isset($type_gird) && $type_gird == 2): ?>
<div class="col-md-6 col-xs-6">
<?php else: ?>
<div class="col-md-4 col-xs-6">
<?php endif; ?>
    <article>
        <div class="figure-grid">
            <div class="image">
                <a href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>">
                    <img src="<?php echo e(FCommon::cover_thumbnail($item->thumbnail, '350')); ?>" alt="<?php echo e($item->title); ?>" width="360" />
                </a>
            </div>
            <div class="text">
                <h2 class="title h4"><a href="<?php echo e(route("frontend.post.detail", $item->slug)); ?>"><?php echo e($item->title); ?></a></h2>
                <sup><?php echo e(Str::currency($item->price_out)); ?> -</sup>
                <sub><?php echo e(Str::currency($item->price_old)); ?></sub>
                <span class="ranking_product clearfix"><?php echo Str::ranking($item->ranking); ?></span>
                <span class="description clearfix"><?php echo e($item->summary); ?></span>
            </div>
        </div>
    </article>
</div>