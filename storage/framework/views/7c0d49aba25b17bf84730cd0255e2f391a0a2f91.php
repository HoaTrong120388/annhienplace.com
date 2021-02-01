<?php $__env->startSection('content'); ?>
<!-- ========================  Header content ======================== -->
<section class="header-content">
    <div class="owl-slider">
        <?php if($home_slider->count()): ?>
            <?php $__currentLoopData = $home_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item" style="background-image:url('<?php echo e($item->thumbnail); ?>')">
                <div class="box">
                    <div class="container">
                        <h2 class="title animated h1" data-animation="fadeInDown"><?php echo e($item->title); ?></h2>
                        <div class="animated" data-animation="fadeInUp">
                            <?php echo e($item->summary); ?>

                        </div>
                        <div class="animated" data-animation="fadeInUp">
                            <a href="<?php echo e($item->link); ?>" target="_blank" class="btn btn-main" ><i class="icon icon-cart"></i> <?php echo e(__("common.button_txt_slider")); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>
<!-- ========================  Icons slider ======================== -->
<section class="owl-icons-wrapper owl-icons-frontpage">
    <!-- === header === -->
    <header class="d-none">
        <h2>Product categories</h2>
    </header>
    <div class="container">
        <div class="owl-icons">
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-sofa"></i>
                    <figcaption>Sofa</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-armchair"></i>
                    <figcaption>Armchairs</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-chair"></i>
                    <figcaption>Chairs</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-dining-table"></i>
                    <figcaption>Dining tables</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-media-cabinet"></i>
                    <figcaption>Media storage</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-table"></i>
                    <figcaption>Tables</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-bookcase"></i>
                    <figcaption>Bookcase</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-bedroom"></i>
                    <figcaption>Bedroom</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-nightstand"></i>
                    <figcaption>Nightstand</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-children-room"></i>
                    <figcaption>Children room</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-kitchen"></i>
                    <figcaption>Kitchen</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-bathroom"></i>
                    <figcaption>Bathroom</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-wardrobe"></i>
                    <figcaption>Wardrobe</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-shoe-cabinet"></i>
                    <figcaption>Shoe cabinet</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-office"></i>
                    <figcaption>Office</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-bar-set"></i>
                    <figcaption>Bar sets</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-lightning"></i>
                    <figcaption>Lightning</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-carpet"></i>
                    <figcaption>Varpet</figcaption>
                </figure>
            </a>
            <!-- === icon item === -->
            <a href="#">
                <figure>
                    <i class="f-icon f-icon-accessories"></i>
                    <figcaption>Accessories</figcaption>
                </figure>
            </a>
        </div> <!--/owl-icons-->
    </div> <!--/container-->
</section>
<!-- ========================  Products widget ======================== -->
<section class="products">
    <div class="container">
        <!-- === header title === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title">Sản Phẩm Nổi Bật</h2>
                    <div class="text">
                        <p>Sản phẩm nổi bật của shop</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="row">
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite added">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-1.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Green corner</a></h2>
                            <sub>$ 1499,-</sub>
                            <sup>$ 1099,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-2.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Laura</a></h2>
                            <sub>$ 3999,-</sub>
                            <sup>$ 3499,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <span class="label label-warning">New</span>
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-3.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Nude</a></h2>
                            <sup>$ 2999,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-4.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Aurora</a></h2>
                            <sup>$ 299,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite added">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <span class="label label-info">-50%</span>
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-5.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Dining set</a></h2>
                            <sub>$ 1999,-</sub>
                            <sup>$ 1499,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
            <!-- === product-item === -->
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="info">
                        <span class="add-favorite">
                            <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                        </span>
                        <span>
                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                        </span>
                    </div>
                    <div class="btn btn-add">
                        <i class="icon icon-cart"></i>
                    </div>
                    <div class="figure-grid">
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="<?php echo e(asset('public/frontend/assets/images/product-6.png')); ?>" alt="" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="product.html">Seat chair</a></h2>
                            <sup>$ 896,-</sup>
                            <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                        </div>
                    </div>
                </article>
            </div>
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="products-grid.html" class="btn btn-main">View store</a>
        </div>
    </div> <!--/container-->
</section>
<!-- ========================  Stretcher widget ======================== -->
<section class="stretcher-wrapper">
    <!-- === stretcher header === -->
    <header class="hidden">
        <!--remove class 'hidden'' to show section header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="h2 title">Popular categories</h1>
                    <div class="text">
                        <p>
                            Whether you are changing your home, or moving into a new one, you will find a huge selection of quality living room furniture,
                            bedroom furniture, dining room furniture and the best value at Furniture factory
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- === stretcher === -->
    <ul class="stretcher">
        <!-- === stretcher item === -->
        <li class="stretcher-item" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/gallery-1.jpg')); ?>);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="f-icon f-icon-bedroom"></span>
                    <span class="text-intro">Bedroom</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Modern furnishing projects</h4>
                <figcaption>New furnishing ideas</figcaption>
            </figure>
            <!--anchor-->
            <a href="#">Anchor link</a>
        </li>
        <!-- === stretcher item === -->
        <li class="stretcher-item" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/gallery-2.jpg')); ?>);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="f-icon f-icon-sofa"></span>
                    <span class="text-intro">Living room</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Furnishing and complements</h4>
                <figcaption>Discover the design table collection</figcaption>
            </figure>
            <!--anchor-->
            <a href="#">Anchor link</a>
        </li>
        <!-- === stretcher item === -->
        <li class="stretcher-item" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/gallery-3.jpg')); ?>);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="f-icon f-icon-office"></span>
                    <span class="text-intro">Office</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Which is Best for Your Home</h4>
                <figcaption>Wardrobes vs Walk-In Closets</figcaption>
            </figure>
            <!--anchor-->
            <a href="#">Anchor link</a>
        </li>
        <!-- === stretcher item === -->
        <li class="stretcher-item" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/gallery-4.jpg')); ?>);">
            <!--logo-item-->
            <div class="stretcher-logo">
                <div class="text">
                    <span class="f-icon f-icon-bathroom"></span>
                    <span class="text-intro">Bathroom</span>
                </div>
            </div>
            <!--main text-->
            <figure>
                <h4>Keeping Things Minimal</h4>
                <figcaption>Creating Your Very Own Bathroom</figcaption>
            </figure>
            <!--anchor-->
            <a href="#">Anchor link</a>
        </li>
        <!-- === stretcher item more=== -->
        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="#"></a>
        </li>
    </ul>
</section>
<!-- ========================  Blog Block ======================== -->
<section class="blog blog-block">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title">Dịch vụ nổi bật</h2>
                    <div class="text">
                        <p>Dịch vụ nổi bật</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="row">
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image">
                            <img src="<?php echo e(asset('public/frontend/assets/images/project-1.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-block">
                            <div class="date">28 Mart 2017</div>
                            <div class="title">
                                <h2 class="h3">Creating the Perfect Gallery Wall </h2>
                            </div>
                            <div class="description">
                                <p>
                                    You’ve finally reached this point in your life- you’ve bought your first home, moved
                                    into your very own apartment, moved out of the dorm room or you’re finally downsizing
                                    after all of your kids have left the nest.
                                </p>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image">
                            <img src="<?php echo e(asset('public/frontend/assets/images/project-2.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-block">
                            <div class="date">25 Mart 2017</div>
                            <div class="title">
                                <h2 class="h3">Making the Most Out of Your Kids Old Bedroom</h2>
                            </div>
                            <div class="description">
                                <p>
                                    You’ve finally reached this point in your life- you’ve bought your first home, moved
                                    into your very own apartment, moved out of the dorm room or you’re finally downsizing
                                    after all of your kids have left the nest.
                                </p>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image">
                            <img src="<?php echo e(asset('public/frontend/assets/images/project-3.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-block">
                            <div class="date">28 Mart 2017</div>
                            <div class="title">
                                <h2 class="h3">Have a look at our new projects!</h2>
                            </div>
                            <div class="description">
                                <p>
                                    You’ve finally reached this point in your life- you’ve bought your first home, moved
                                    into your very own apartment, moved out of the dorm room or you’re finally downsizing
                                    after all of your kids have left the nest.
                                </p>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="ideas.html" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>
<!-- ========================  Banner ======================== -->
<section class="banner" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/gallery-4.jpg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="title">Về chúng tôi</h2>
                <p>
                    We believe in creativity as one of the major forces of progress. With this idea, we traveled throughout Italy to find exceptional
                    artisans and bring their unique handcrafted objects to connoisseurs everywhere.
                </p>
                <p><a href="about.html" class="btn btn-clean">Read full story</a></p>
            </div>
        </div>
    </div>
</section>
<!-- ========================  Blog ======================== -->
<section class="blog">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="h2 title">Tin tức</h1>
                    <div class="text">
                        <p>Latest news from the blog</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="row">
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/blog-1.jpg')); ?>)">
                            <img src="<?php echo e(asset('public/frontend/assets/images/blog-1.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-table">
                            <div class="date-wrapper">
                                <div class="date">
                                    <span>MAR</span>
                                    <strong>08</strong>
                                    <span>2017</span>
                                </div>
                            </div>
                            <div class="title">
                                <h2 class="h5">The 3 Tricks that Quickly Became Rules</h2>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/blog-2.jpg')); ?>)">
                            <img src="<?php echo e(asset('public/frontend/assets/images/blog-1.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-table">
                            <div class="date-wrapper">
                                <div class="date">
                                    <span>MAR</span>
                                    <strong>03</strong>
                                    <span>2017</span>
                                </div>
                            </div>
                            <div class="title">
                                <h2 class="h5">Decorating When You're Starting Out or Starting Over</h2>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
            <!-- === blog item === -->
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image" style="background-image:url(<?php echo e(asset('public/frontend/assets/images/blog-8.jpg')); ?>)">
                            <img src="<?php echo e(asset('public/frontend/assets/images/blog-8.jpg')); ?>" alt="" />
                        </div>
                        <div class="entry entry-table">
                            <div class="date-wrapper">
                                <div class="date">
                                    <span>MAR</span>
                                    <strong>01</strong>
                                    <span>2017</span>
                                </div>
                            </div>
                            <div class="title">
                                <h2 class="h5">What does your favorite dining chair say about you?</h2>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem tất cả</span>
                        </div>
                    </a>
                </article>
            </div>
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="blog-grid.html" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>