<!-- ========================  Blog Block ======================== -->
<section class="blog blog-block">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! __('common.home_service_title') !!}
                </div>
            </div>
        </header>
        <div class="row">
            @foreach ($home_service as $item)
                @include('frontend.content.service.item-service')
            @endforeach
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="{{ route("frontend.service.all") }}" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>