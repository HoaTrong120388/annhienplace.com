@extends('frontend.layouts.layout')
@section('content')
<!-- ========================  Header content ======================== -->
<section class="header-content">
    <div class="owl-slider">
        @if ($home_slider->count())
            @foreach ($home_slider as $item)
            <div class="item" style="background-image:url('{{ FCommon::cover_thumbnail($item->thumbnail) }}')">
                <div class="box">
                    <div class="container">
                        <h2 class="title animated h1" data-animation="fadeInDown">{{ $item->title }}</h2>
                        <div class="animated" data-animation="fadeInUp">
                            {!! $item->summary !!}
                        </div>
                        <div class="animated" data-animation="fadeInUp">
                            <a href="{{ $item->link }}" target="_blank" class="btn btn-main" ><i class="icon icon-cart"></i> {{ __("common.button_txt_slider") }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
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
                    <h2 class="title">Danh mục nổi bật</h2>
                    <div class="text">
                        <p>Sản phẩm nổi bật của shop</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="row">
            @foreach ($home_product as $item)
            <div class="col-md-4 col-xs-6">
                <article>
                    <div class="figure-grid">
                        <div class="image">
                            <a href="#productid1" class="mfp-open">
                                <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" width="360" />
                            </a>
                        </div>
                        <div class="text">
                            <h2 class="title h4"><a href="{{ route("frontend.post.detail", $item->slug) }}">{{ $item->title }}</a></h2>
                            <sup>{{ Str::currency($item->price_old) }} -</sup>
                            <sub>{{ Str::currency($item->price_out) }}-</sub>
                            <span class="description clearfix">{{ $item->summary }}</span>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <div class="wrapper-more">
            <a href="{{ route('frontend.product.all') }}" class="btn btn-main">Xem thêm</a>
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
                    <h1 class="h2 title">Danh mục nổi bật</h1>
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
        @foreach ($home_catalog as $item)
        <li class="stretcher-item" style="background-image:url('{{ FCommon::cover_thumbnail($item->banner_home) }}');">
            <div class="stretcher-logo">
                <div class="text">
                    <span class="f-icon f-icon-bedroom"></span>
                    <span class="text-intro">{{ $item->title }}</span>
                </div>
            </div>
            <figure>
                <h4>{{ $item->title }}</h4>
                <figcaption>{{ $item->summary }}</figcaption>
            </figure>
            <a href="{{ route("frontend.catalog.detail", $item->slug) }}">Chi tiết</a>
        </li>
        @endforeach
        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="{{ route('frontend.product.all') }}"></a>
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
            @foreach ($home_service as $item)
            <div class="col-sm-4">
                <article>
                    <a href="{{ route("frontend.post.detail", $item->slug) }}">
                        <div class="image">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" />
                        </div>
                        <div class="entry entry-block">
                            <div class="date">{{ Carbon::parse($item->created_at)->format('Y-m-d') }}</div>
                            <div class="title">
                                <h2 class="h3">{{ $item->title }}</h2>
                            </div>
                            <div class="description">
                                {!! $item->summary !!}
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem chi tiết</span>
                        </div>
                    </a>
                </article>
            </div>
            @endforeach
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="{{ route("frontend.service.all") }}" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>
<!-- ========================  Banner ======================== -->
<section class="banner" style="background-image:url({{ asset('public/frontend/assets/images/gallery-4.jpg') }})">
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
            @foreach ($home_news as $item)
            <div class="col-sm-4">
                <article>
                    <a href="article.html">
                        <div class="image" style="background-image:url('{{ FCommon::cover_thumbnail($item->thumbnail) }}')">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" />
                        </div>
                        <div class="entry entry-table">
                            <div class="date-wrapper">
                                <div class="date">
                                    <span>{{ Carbon::parse($item->created_at)->format('M') }}</span>
                                    <strong>{{ Carbon::parse($item->created_at)->format('d') }}</strong>
                                    <span>{{ Carbon::parse($item->created_at)->format('Y') }}</span>
                                </div>
                            </div>
                            <div class="title">
                                <h2 class="h5">{{ $item->title }}</h2>
                            </div>
                        </div>
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem chi tiết</span>
                        </div>
                    </a>
                </article>
            </div>
            @endforeach
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="blog-grid.html" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>
@endsection