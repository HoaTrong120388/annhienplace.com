<!-- ========================  Icons slider ======================== -->
<section class="owl-icons-wrapper owl-icons-frontpage">
    <!-- === header === -->
    <header class="d-none">
        <h2>{!! __('common.home_slider_catalog') !!}</h2>
    </header>
    <div class="container">
        <div class="owl-icons">
            @foreach ($home_catalog as $item)
            <a href="{{ route("frontend.catalog.detail", $item->slug) }}">
                <figure>
                    <span class="img-icon">
                        <img src="{{ FCommon::cover_thumbnail($item->icon) }}" alt="{{ $item->title }}">
                    </span>
                    <figcaption>{{ $item->title }}</figcaption>
                </figure>
            </a>
            @endforeach
        </div> <!--/owl-icons-->
    </div> <!--/container-->
</section>