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
                                    <img src="{{ FCommon::cover_thumbnail($alb, 'nullx500') }}" alt="{{ $rs['title'] }}" height="500" />
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
                                    <span> Giới thiệu</span>
                                </a>
                            </li>
                            <li role="nav-item">
                                <a href="#rating" class="nav-link" data-toggle="tab">
                                    <i class="icon icon-thumbs-up"></i>
                                    <span> Đánh giá</span>
                                </a>
                            </li>
                            <li role="nav-item">
                                <a href="#info" class="nav-link"  data-toggle="tab">
                                    <i class="icon icon-tag"></i>
                                    <span> Xem thêm</span>
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
                                <div class="content">
                                    <h3>Sản phẩm cùng danh mục</h3>
                                    @if ($arrRelated->count() > 0)
                                    <div class="products">
                                        <div class="row">
                                            @foreach ($arrRelated as $item)
                                                @include('frontend.content.product.item-product', ['item' =>  $item, 'type_gird' => 2])
                                            @endforeach
                                        </div> <!--/row-->
                                    </div>
                                    @endif
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
                                                <div class="rating clearfix"></div>
                                                @if ($arrComment->count() > 0)
                                                <div class="comment-wrapper">
                                                    @include('frontend.common.comment-list')
                                                </div>
                                                <div class="comment-header">
                                                    <a href="#" class="btn btn-clean-dark">{{ $arrComment->count() }} comments</a>
                                                </div>
                                                @endif
                                                @include('frontend.common.form-comment')
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