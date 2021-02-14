<li class="<?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>">
    <div class="fb-share-button" data-href="<?php echo e(url()->current()); ?>" data-layout="button" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a>
    </div>
</li>

<li class="<?php if(isset($class)): ?> <?php echo e($class); ?> <?php endif; ?>">
    <div class="zalo-share-button" data-href="" data-oaid="300294648877084668" data-layout="1" data-color="blue" data-customize=false></div>
</li>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=827469944022016&autoLogAppEvents=1" nonce="OuYI9WLj"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>