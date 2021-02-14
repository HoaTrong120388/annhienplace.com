<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.common.header-content', ['type' => 'blog'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="blog">
        <?php if(!empty($rs['album'])): ?>
        <div class="container" id="container" style="text-align: center;display: flex;flex-flow: column nowrap;justify-content: center;align-items: center;">
            <div id="catalog">
                <?php $__currentLoopData = $rs['album']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <img src="<?php echo e(FCommon::cover_thumbnail($alb)); ?>" alt="<?php echo e($rs['title']); ?>" />
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-5"></div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a  class="page-link" id='first'      href="javascript:void(0);" title=''><i class="fa fa-fast-backward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='back'       href="javascript:void(0);" title=''><i class="fa fa-backward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='next'       href="javascript:void(0);" title=''><i class="fa fa-forward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='last'       href="javascript:void(0);" title=''><i class="fa fa-fast-forward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='zoomout'    href="javascript:void(0);" title=''><i class="fa fa-search-minus"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='zoomin'     href="javascript:void(0);" title=''><i class="fa fa-search-plus"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='slideshow'  href="javascript:void(0);" title=''><i class="fa fa-play"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='flipsound'  href="javascript:void(0);" title=''><i class="fa fa-volume-up"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='fullscreen' href="javascript:void(0);" title=''><i class="fa fa-expand"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='thumbs'     href="javascript:void(0);" title=''><i class="fa fa-th"></i></a></li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('headerstyle'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/all/plugin/wowbook/css/wow_book.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    <script src="<?php echo e(asset('public/all/plugin/wowbook/js/wow_book.js')); ?>"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            $('#catalog').wowBook({
                height : 400,
                width  : 600,
                flipSound: false,
                centeredWhenClosed : true,
                hardcovers : true,
                turnPageDuration : 1000,
                numberedPages : [1,-2],
                controls : {
                    zoomIn    : '#zoomin',
                    zoomOut   : '#zoomout',
                    next      : '#next',
                    back      : '#back',
                    first     : '#first',
                    last      : '#last',
                    slideShow : '#slideshow',
                    flipSound : '#flipsound',
                    thumbnails : '#thumbs',
                    fullscreen : '#fullscreen'
                },
                scaleToFit: "#container",
                thumbnailsPosition : 'bottom'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>