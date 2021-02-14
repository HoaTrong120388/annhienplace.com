<!-- ========================  Products widget ======================== -->
<section class="products">
    <div class="container">
        <!-- === header title === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! __('common.home_product_title') !!}
                </div>
            </div>
        </header>
        <div class="row">
            @foreach ($home_product as $item)
                @include('frontend.content.product.item-product')
            @endforeach
        </div>

        <div class="wrapper-more">
            <a href="{{ route('frontend.product.all') }}" class="btn btn-main">Xem thêm</a>
        </div>
    </div> <!--/container-->
</section>