<?php $__env->startSection('content'); ?>
<!-- ======================== Main header ======================== -->
<section class="main-header" style="background-image:url('public/frontend/assets/images/bg-02.jpg')">
    <header>
        <div class="container">
            <h1 class="h2 title">Shop</h1>
            <ol class="breadcrumb breadcrumb-inverted">
                <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                <li><a href="category.html">Product Category</a></li>
                <li><a class="active" href="products-grid.html">Product Sub-category</a></li>
            </ol>
        </div>
    </header>
</section>
<!-- ======================== Products ======================== -->
<section class="products">
    <div class="container">
        <header class="">
            <h3 class="h3 title">Product category with topbar</h3>
        </header>
        <div class="row">
            <!-- === product-items === -->
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <?php for($i = 0; $i < 6; $i++): ?>
                        <?php echo $__env->make('frontend.content.list.item-product.item', ['arrResult' =>  $i], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endfor; ?>
                </div><!--/row-->
                <!--Pagination-->
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
                </div>
            </div> <!--/product items-->
        </div><!--/row-->
        <!-- ========================  Product info popup - quick view ======================== -->
        <div class="popup-main mfp-hide" id="productid1">
            <!-- === product popup === -->
            <div class="product">
                <!-- === popup-title === -->
                <div class="popup-title">
                    <div class="h1 title">Laura <small>product category</small></div>
                </div>
                <!-- === product gallery === -->
                <div class="owl-product-gallery">
                    <img src="assets/images/product-1.png" alt="" width="640" />
                    <img src="assets/images/product-2.png" alt="" width="640" />
                    <img src="assets/images/product-3.png" alt="" width="640" />
                    <img src="assets/images/product-4.png" alt="" width="640" />
                </div>
                <!-- === product-popup-info === -->
                <div class="popup-content">
                    <div class="product-info-wrapper">
                        <div class="row">
                            <!-- === left-column === -->
                            <div class="col-sm-6">
                                <div class="info-box">
                                    <strong>Maifacturer</strong>
                                    <span>Brand name</span>
                                </div>
                                <div class="info-box">
                                    <strong>Materials</strong>
                                    <span>Wood, Leather, Acrylic</span>
                                </div>
                                <div class="info-box">
                                    <strong>Availability</strong>
                                    <span><i class="fa fa-check-square-o"></i> in stock</span>
                                </div>
                            </div>
                            <!-- === right-column === -->
                            <div class="col-sm-6">
                                <div class="info-box">
                                    <strong>Available Colors</strong>
                                    <div class="product-colors clearfix">
                                        <span class="color-btn color-btn-red"></span>
                                        <span class="color-btn color-btn-blue checked"></span>
                                        <span class="color-btn color-btn-green"></span>
                                        <span class="color-btn color-btn-gray"></span>
                                        <span class="color-btn color-btn-biege"></span>
                                    </div>
                                </div>
                                <div class="info-box">
                                    <strong>Choose size</strong>
                                    <div class="product-colors clearfix">
                                        <span class="color-btn color-btn-biege">S</span>
                                        <span class="color-btn color-btn-biege checked">M</span>
                                        <span class="color-btn color-btn-biege">XL</span>
                                        <span class="color-btn color-btn-biege">XXL</span>
                                    </div>
                                </div>
                            </div>
                        </div><!--/row-->
                    </div> <!--/product-info-wrapper-->
                </div><!--/popup-content-->
                <!-- === product-popup-footer === -->
                <div class="popup-table">
                    <div class="popup-cell">
                        <div class="price">
                            <span class="h3">$ 1999,00 <small>$ 2999,00</small></span>
                        </div>
                    </div>
                    <div class="popup-cell">
                        <div class="popup-buttons">
                            <a href="product.html"><span class="icon icon-eye"></span> <span class="hidden-xs">View more</span></a>
                            <a href="javascript:void(0);"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>
                        </div>
                    </div>
                </div>
            </div> <!--/product-->
        </div> <!--popup-main-->
    </div><!--/container-->
</section>
<!-- ================== Footer  ================== -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('headerstyle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>