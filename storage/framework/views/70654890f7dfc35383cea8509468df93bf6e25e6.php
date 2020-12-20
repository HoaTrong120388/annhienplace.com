<?php $__env->startSection('content'); ?>
<!-- ========================  Main header ======================== -->
<section class="main-header" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/bg-02.jpg')); ?>)">
    <header>
        <div class="container">
            <h1 class="h2 title">Danh mục tin tức</h1>
            <ol class="breadcrumb breadcrumb-inverted">
                <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                <li><a href="blog-1.html">Tin tức</a></li>
                <li><a class="active" href="blog-1.html">Danh mục tin tức</a></li>
            </ol>
        </div>
    </header>
</section>
<!-- ========================  Blog ======================== -->
<section class="blog">
    <div class="container">
        <div class="pre-header">
            <div>
                <h2 class="h3 title">
                    Danh mục tin tức
                </h2>
            </div>
        </div>
        <div class="row">
            <!-- === blog-item === -->
            <?php for($i = 0; $i < 12; $i++): ?>
                <div class="col-sm-4">
                    <article>
                        <a href="article.html">
                            <div class="image" style="background-image:url('https://images.careerbuilder.vn/tintuc/career/20200401/crop/360x140/1585705266_tn0104.png')">
                                <img src="assets/images/blog-1.jpg" alt="" />
                            </div>
                            <div class="entry entry-table">
                                <div class="date-wrapper">
                                    <div class="date">
                                        <span>MAR</span>
                                        <strong>05</strong>
                                        <span>2017</span>
                                    </div>
                                </div>
                                <div class="title">
                                    <h2 class="h5">The 3 Tricks that Quickly Became Rules</h2>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
            <?php endfor; ?>
        </div> <!--/row-->
        <!-- === pagination === -->
        <div class="pagination-wrapper">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div> <!--/pagination-->
    </div><!--/container-->
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headerstyle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>