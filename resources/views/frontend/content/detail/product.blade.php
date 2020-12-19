@extends('frontend.layout')
@section('headerstyle')
@endsection
@section('content')
<div class="main-content">
    <div class="container">
        @if (!empty($breadcrumb))
            <ul class="breadcrumb">
                @foreach ($breadcrumb as $bre)
                    <li><a href="{{ $bre['link'] }}">{{ $bre['title'] }}</a></li>
                @endforeach
            </ul>
        @endif
        <div class="product-details-content">
            <div class="col-md-6 col-sm-6">
                <div class="product-img-box">
                <a id="image-view" title="Product Image">
                    <img id="image" src="{{ FCommon::cover_thumbnail($arrResult->thumbnail) }}" alt="Product"/>
                </a>
                <div class="product-thumb">
                    <?php $arr_album = isset($arrResult->album)?json_decode($arrResult->album):array(); ?>
                    <ul class="thumb-content">
                        @foreach ($arr_album as $alb)
                            <li class="thumb">
                                <a href="{{ FCommon::cover_thumbnail($alb) }}" onclick="swap(this);return false;">
                                    <img src="{{ FCommon::cover_thumbnail($alb, '200x200') }}"/>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="product-name space-30">
                    <h1>{{ $title_detail or '' }}</h1>
                    <div class="product-summary">
                        {{ strip_tags ($arrResult->summary) }}
                    </div>
                </div>
                <div class="rating">
                    <div class="overflow-h">
                        <div class="icon-rating">
                            <input type="radio" id="star-horizontal-rating-1" name="star-horizontal-rating" checked="">
                            <label for="star-horizontal-rating-1"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-horizontal-rating-2" name="star-horizontal-rating" checked="">
                            <label for="star-horizontal-rating-2"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-horizontal-rating-3" name="star-horizontal-rating" checked="">
                            <label for="star-horizontal-rating-3"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-horizontal-rating-4" name="star-horizontal-rating">
                            <label for="star-horizontal-rating-4"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-horizontal-rating-5" name="star-horizontal-rating">
                            <label for="star-horizontal-rating-5"><i class="fa fa-star"></i></label>
                        </div>
                        <ul>
                            <li>3 Rating(s)</li>
                            <li><a href="#" title="add your rating">Add Your Rating</a></li>
                        </ul>
                    </div>
                </div>
                <div class="wrap-price space-30 space-padding-tb-30">
                    <p class="price">$ 69.90</p>
                </div>
                <div class="products">
                    <div class="product product-details">
                        <a href="javascript:void(0);" class="add-to-cart">Call For You</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hoz-tab-container space-padding-tb-40">
            <ul class="tabs">
                <li class="item" rel="description">Description</li>
                <li class="item" rel="customer">Customer Review</li>
            </ul>
            <div class="tab-container">
                <div id="description" class="tab-content">
                    {!! $arrResult->content !!}
                </div>
                <div id="customer" class="tab-content">
                    <div class="col-md-6">
                        <h3 class="space-10">Customer Review</h3>
                        <div class="space-10">
                            <p>Perfect <strong>Review by Tony</strong></p>
                            <div class="icon-rating">
                                <p>Price:</p>
                                <input type="radio" id="bird-horizontal-rating-1" name="bird-horizontal-rating" checked="">
                                <label for="bird-horizontal-rating-1"><i class="fa fa-star"></i></label>
                                <input type="radio" id="bird-horizontal-rating-2" name="bird-horizontal-rating" checked="">
                                <label for="bird-horizontal-rating-2"><i class="fa fa-star"></i></label>
                                <input type="radio" id="bird-horizontal-rating-3" name="bird-horizontal-rating">
                                <label for="bird-horizontal-rating-3"><i class="fa fa-star"></i></label>
                                <input type="radio" id="bird-horizontal-rating-4" name="bird-horizontal-rating">
                                <label for="bird-horizontal-rating-4"><i class="fa fa-star"></i></label>
                                <input type="radio" id="bird-horizontal-rating-5" name="bird-horizontal-rating">
                                <label for="bird-horizontal-rating-5"><i class="fa fa-star"></i></label>
                            </div>
                            <p>Like (Posted on 16/07/2015)</p>
                        </div>
                        <div class="space-padding-tb-40">
                            <h4>Customer Review</h4>
                            <p>You're reviewing: Wash Out Parama</p>
                            <p>How do you rate this product?*</p>
                        </div>
                        <div class="space-10">
                            <h4>Customer Review</h4>
                            <form class="radio customer-radio">
                                <input type="radio" id="star-1" value="1" name="star"/>
                                <label for="star-1">01 star</label>
                                <input type="radio" id="star-2" value="2" name="star" />
                                <label for="star-2">02 star</label>
                                <input type="radio" id="star-3" value="3" name="star" />
                                <label for="star-3">03 star</label>
                                <input type="radio" id="star-4" value="4" name="star" checked/>
                                <label for="star-4">04 star</label>
                                <input type="radio" id="star-5" value="5" name="star" />
                                <label for="star-5">05 star</label>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class=" control-label" for="inputName">Nick Name*</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label" for="inputsumary">Summary of Your Review *</label>
                                    <input type="text" class="form-control" id="inputsumary" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class=" control-label" for="inputReview">Review*</label>
                                    <input type="text" class="form-control" id="inputReview" placeholder="Review*">
                                </div>
                                <button class="btn link-button link-button-v2" type="submit">Submit review</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="title-product">
            <h3>Products Related</h3>
        </div>
        <div class="upsell-product products grid_full">
            @if (!empty($arrResult_Related) && count($arrResult_Related) > 0)
                @foreach ($arrResult_Related as $item)
                    <div class="item-inner">
                        <div class="product">
                            <a class="product-images" href="{{ URL::route('frontend.post.detail', $item->slug) }}" title="">
                                <img class="primary_image" src="{{ FCommon::cover_thumbnail($item->thumbnail, '870x565') }}" alt=""/>
                                <img class="secondary_image" src="{{ FCommon::cover_thumbnail($item->thumbnail, '870x565') }}" alt=""/>
                            </a>
                            <p class="product-title">
                                <a class="product-images" href="{{ URL::route('frontend.post.detail', $item->slug) }}" title="">
                                    {{ FCommon::print_Element($item->title) }}
                                </a>
                            </p>
                            <p class="description">
                                    {!! str_limit(strip_tags($item->summary), $limit = 50, $end = '...') !!}
                            </p>
                            <p class="product-price">{{ number_format($item->price_out,0,',','.') }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
            @for ($i = 0; $i < 4; $i++)
            
            @endfor

        </div>
    </div>
</div>
@endsection

@section('footerjs')
@endsection