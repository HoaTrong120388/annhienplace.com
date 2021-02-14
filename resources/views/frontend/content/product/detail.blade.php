@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content')
    <!-- ========================  Product ======================== -->
    <section class="product">
        <div class="main">
            <div class="container">
                <div class="row product-flex">
                    <div class="col-md-4 col-sm-12 product-flex-info">
                        <h1 class="title">
                            {{ $rs['title'] ?? '' }}
                            <small>{{ $arrResult->parentcategory->title ?? '' }}</small>
                        </h1>
                        <div class="price">
                            <span class="h3">
                                {{ Str::currency($rs['price_out'], 2) }}
                                @if (!empty($rs['price_in']))
                                <small>{{ Str::currency($rs['price_in'], 2) }}</small>
                                @endif
                            </span>
                        </div>
                        <hr />
                        <!-- === info-box === -->
                        <div class="info-box">
                            <span><strong>Thương hiệu</strong></span>
                            <span>{{ $rs['more_info']['brand'] ?? '' }}</span>
                        </div>
                        <div class="info-box">
                            <span><strong>Nguồn gốc</strong></span>
                            <span>{{ $rs['more_info']['source'] ?? '' }}</span>
                        </div>
                        <div class="info-box">
                            <span><strong>Nguyên liệu</strong></span>
                            <span>{{ $rs['more_info']['materials'] ?? '' }}</span>
                        </div>
                        <!-- === info-box === -->
                        <div class="info-box">
                            <span><strong>Tình trạng</strong></span>
                            @if ($rs['in_stocks'] == 1)
                                <span class="text-success""><i class="fa fa-check-square-o"></i> Còn hàng</span>
                            @else
                                <span class="text-danger"><i class="fa fa-truck"></i> Hết hàng</span>
                            @endif
                        </div>
                        <hr />
                        <!--/product-info-wrapper-->
                    </div>
                    <!--/col-md-4-->

                    <!-- === product item gallery === -->
                    <div class="col-md-8 col-sm-12 product-flex-gallery">
                        @if (!empty($rs['album']))
                            <div class="owl-product-gallery open-popup-gallery">
                                @foreach ($rs['album'] as $alb)
                                <a href="{{ FCommon::cover_thumbnail($alb) }}">
                                    <img src="{{ FCommon::cover_thumbnail($alb, '200x200') }}" alt="{{ $rs['title'] }}" height="500" />
                                </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- === product-info === -->

        <div class="info">
            <div class="container">
                <div class="row">
                    <!-- === product-designer === -->
                    <div class="col-md-4">
                        <div class="designer">
                            <div class="box">
                                <div class="image">
                                    <img src="{{ FCommon::cover_thumbnail($rs['thumbnail'], '200x200') }}" alt="{{ $rs['title'] }}" />
                                </div>
                                <div class="name">
                                    <div class="h3 title">
                                        {{ $rs['title'] }}
                                        <small>{{ $arrResult->parentcategory->title ?? '' }}</small>
                                    </div>
                                    <hr />
                                    <p>
                                        <a href="mailto:{{ $setting_result['company_email'] ?? '' }}">
                                            <i class="icon icon-envelope"></i>
                                            {{ $setting_result['company_email'] ?? '' }}
                                        </a>
                                    </p>
                                    <p>
                                        <a href="tel:{{ $setting_result['company_phone'] ?? '' }}">
                                            <i class="icon icon-phone-handset"></i>
                                            {{ $setting_result['company_phone'] ?? '' }}
                                        </a>
                                    </p>
                                </div>
                                <!--/name-->
                            </div>
                            <!--/box-->
                            <div class="btn btn-add">
                                <i class="icon icon-phone-handset"></i>
                            </div>
                        </div>
                        <!--/designer-->
                    </div>
                    <!--/col-md-4-->
                    <!-- === nav-tabs === -->

                    <div class="col-md-8">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="nav-item" >
                                <a href="#content" class="nav-link active" data-toggle="tab">
                                    <i class="icon icon-user"></i>
                                    <span> Miêu tả</span>
                                </a>
                            </li>
                            <li role="nav-item">
                                <a href="#info" class="nav-link"  data-toggle="tab">
                                    <i class="icon icon-sort-alpha-asc"></i>
                                    <span> Thông số</span>
                                </a>
                            </li>
                            <li role="nav-item">
                                <a href="#rating" class="nav-link" data-toggle="tab">
                                    <i class="icon icon-thumbs-up"></i>
                                    <span> Đánh giá</span>
                                </a>
                            </li>
                        </ul>

                        <!-- === tab-panes === -->

                        <div class="tab-content">
                            <!-- ============ tab #2 ============ -->
                            <div role="tabpanel" class="tab-pane active" id="content">
                                <div class="pg-detail">
                                    {!! $rs['content'] !!}
                                </div>
                            </div>

                            <!-- ============ tab #2 ============ -->
                            <div role="tabpanel" class="tab-pane" id="info">
                                <div class="pg-detail">
                                    Đang cập nhật
                                </div>
                            </div>

                            <!-- ============ tab #3 ============ -->
                            <div role="tabpanel" class="tab-pane" id="rating">
                                <!-- ============ ratings ============ -->
                                <div class="content">
                                    <h3>Đánh giá</h3>
                                    <div class="row">
                                        <!-- === comments === -->
                                        <div class="col-md-12">
                                            <div class="comments">
                                                <div class="rating clearfix">
                                                    <div class="rate-box">
                                                        <div class="rating">
                                                            {!! Str::rank(1) !!}
                                                            <span> 3</span>
                                                        </div>
                                                        <div class="rating">
                                                            {!! Str::rank(2) !!}
                                                            <span> 5</span>
                                                        </div>
                                                        <div class="rating">
                                                            {!! Str::rank(3) !!}
                                                            <span> 0</span>
                                                        </div>
                                                        <div class="rating">
                                                            {!! Str::rank(4) !!}
                                                            <span> 2</span>
                                                        </div>
                                                        <div class="rating">
                                                            {!! Str::rank(5) !!}
                                                            <span> 1</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="comment-wrapper">
                                                    <div class="comment-block">
                                                        <div class="comment-user">
                                                            <div><img src="{{ asset('public/frontend/assets/images/user-2.jpg') }}" alt="Alternate Text" width="70" /></div>
                                                            <div>
                                                                <h5>
                                                                    <span>John Doe</span>
                                                                    <span class="pull-right">
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </span>
                                                                    <small>03.05.2017</small>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <!-- comment description -->

                                                        <div class="comment-desc">
                                                            <p>
                                                                In vestibulum tellus ut nunc accumsan eleifend. Donec mattis
                                                                cursus ligula, id
                                                                iaculis dui feugiat nec. Etiam ut ante sed neque lacinia
                                                                volutpat. Maecenas
                                                                ultricies tempus nibh, sit amet facilisis mauris vulputate
                                                                in. Phasellus
                                                                tempor justo et mollis facilisis. Donec placerat at nulla
                                                                sed suscipit. Praesent
                                                                accumsan, sem sit amet euismod ullamcorper, justo sapien
                                                                cursus nisl, nec
                                                                gravida
                                                            </p>
                                                        </div>

                                                        <!-- comment reply -->

                                                        <div class="comment-block">
                                                            <div class="comment-user">
                                                                <div><img src="{{ asset('public/frontend/assets/images/user-2.jpg') }}" alt="Alternate Text" width="70" /></div>
                                                                <div>
                                                                    <h5>Administrator<small>08.05.2017</small></h5>
                                                                </div>
                                                            </div>
                                                            <div class="comment-desc">
                                                                <p>
                                                                    Curabitur sit amet elit quis tellus tincidunt efficitur.
                                                                    Cras lobortis id
                                                                    elit eu vehicula. Sed porttitor nulla vitae nisl varius
                                                                    luctus. Quisque
                                                                    a enim nisl. Maecenas facilisis, felis sed blandit
                                                                    scelerisque, sapien
                                                                    nisl egestas diam, nec blandit diam ipsum eget dolor.
                                                                    Maecenas ultricies
                                                                    tempus nibh, sit amet facilisis mauris vulputate in.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!--/reply-->
                                                    </div>
                                                </div>
                                                <div class="comment-header">
                                                    <a href="#" class="btn btn-clean-dark">12 comments</a>
                                                </div>

                                                <!-- === add comment === -->
                                                <div class="comment-add">

                                                    <div class="comment-reply-message">
                                                        <div class="h3 title">Leave a Reply </div>
                                                        <p>Your email address will not be published.</p>
                                                    </div>

                                                    <form action="#" method="post">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name" value=""
                                                                placeholder="Your Name" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="name" value=""
                                                                placeholder="Your Email" />
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea rows="10" class="form-control"
                                                                placeholder="Your comment"></textarea>
                                                        </div>
                                                        <div class="clearfix text-center">
                                                            <a href="#" class="btn btn-main">Add comment</a>
                                                        </div>
                                                    </form>

                                                </div>
                                                <!--/comment-add-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                </div>
                            </div>

                        </div>
                        <!--/tab-content-->
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/container-->
        </div>
        <!--/info-->
    </section>

@endsection