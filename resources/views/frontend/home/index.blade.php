@extends('frontend.layouts.layout')
@section('content')
    <!-- ========================  Header content ======================== -->
    <section class="header-content">
        <div class="owl-slider owl-slider-fullscreen">
            <!-- === slide item === -->
            <div class="item" style="background-image:url({{ asset('public/frontend/assets/images/bg-01.jpg') }})">
                <div class="box">
                    <div class="container text-center">
                        <h2 class="title animated h1" data-animation="fadeInDown">Modern furniture theme</h2>
                        <div class="animated" data-animation="fadeInUp">
                            Modern & powerfull template. <br /> Clean design & reponsive
                            layout. Google fonts integration
                        </div>
                    </div>
                </div>
            </div>
            <!-- === slide item === -->
            <div class="item" style="background-image:url({{ asset('public/frontend/assets/images/bg-02.jpg') }})">
                <div class="box">
                    <div class="container text-center">
                        <h2 class="title animated h1" data-animation="fadeInDown">Mobile ready!</h2>
                        <div class="animated" data-animation="fadeInUp">Unlimited Choices. Unbeatable Prices. Free Shipping.</div>
                        <div class="animated" data-animation="fadeInUp">Furniture category icon fonts!</div>
                    </div>
                </div>
            </div>
        </div> <!--/owl-slider-->
    </section>
    <!-- ========================  Products widget ======================== -->
    <section class="products">
        <div class="container">
            <!-- === header title === -->
            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="title">Sản Phẩm Nổi Bật</h2>
                        <div class="text">
                            <p>Dòng sản phẩm tiêu biểu</p>
                        </div>
                    </div>
                </div>
            </header>
            <div class="row">
                @for ($i = 0; $i < 6; $i++)
                    @include('frontend.content.list.item-product.item', ['arrResult' =>  $i])
                @endfor
            </div>
            <div class="wrapper-more">
                <a href="./shops" class="btn btn-main">Xem tất cả sản phẩm</a>
            </div>
            
        </div> <!--/container-->
    </section>
    <!-- ========================  Banner ======================== -->
    <section class="banner" style="background-image:url({{ asset('public/frontend/assets/images/gallery-4.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <h2 class="title">Về Chúng Tôi</h2>
                    <p>HỆ THỐNG CẢM BIẾN ÁP SUẤT LỐP – TPMS CHÍNH HÃNG CAREUD </p>
                    <p>CAREUD là công ty chuyên sản xuất các thiết bị công nghệ, có lịch sử gần 15 năm.</p>
                    <p>Các thiết bị bao gồm: “Hệ thống giám sát áp suất lốp – TPMS không dây” sử dụng pin sạc Lithium và hệ thống giám sát áp suất lốp loại pin Năng lượng mặt trời, camera hành trình, camera an ninh, … với hình thức sản xuất thương mại độc lập và gia công cho hầu hết các hãng xe lớn Mỹ, Châu Âu, Nhật Bản.</p>
                    <a href="javascript:void(0);" class="btn btn-clean">Chi tiết</a></p>
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
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h1 class="h2 title">Tin tức</h1>
                        <div class="text">
                            <p>Bài viết mới cập nhật</p>
                        </div>
                    </div>
                </div>
            </header>
            <div class="row">
                @for ($i = 1; $i < 4; $i++)
                    <div class="col-sm-4">
                        <article>
                            <a href="article.html">
                                <div class="image" style="background-image:url('https://images.careerbuilder.vn/tintuc/career/20200401/crop/360x140/1585705266_tn0104.png')">
                                    <img src="{{ asset('public/frontend/assets/images/blog-1.jpg') }}" alt="" />
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
                                    <span class="btn btn-main btn-block">Read more</span>
                                </div>
                            </a>
                        </article>
                    </div>
                @endfor
            </div> <!--/row-->
            <!-- === button more === -->
            <div class="wrapper-more">
                <a href="blog-grid.html" class="btn btn-main">View all posts</a>
            </div>
        </div> <!--/container-->
    </section>
@endsection
@section('headerstyle')
@endsection
@section('footerjs')
@endsection