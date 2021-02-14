<!-- ========================  Stretcher widget ======================== -->
<section class="stretcher-wrapper">
    <!-- === stretcher header === -->
    <header class="hidden">
        <!--remove class 'hidden'' to show section header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! __('common.home_catalog_title') !!}
                </div>
            </div>
        </div>
    </header>
    <!-- === stretcher === -->
    <ul class="stretcher">
        @foreach ($home_catalog as $item)
            @if ($loop->index < 4)
            <li class="stretcher-item" style="background-image:url('{{ FCommon::cover_thumbnail($item->banner_home) }}');">
                <div class="stretcher-logo">
                    <div class="text">
                        <span class="img-icon">
                            <img src="{{ FCommon::cover_thumbnail($item->icon) }}" alt="{{ $item->title }}">
                        </span>
                        <span class="text-intro">{{ $item->title }}</span>
                    </div>
                </div>
                <figure>
                    <h4>{{ $item->title }}</h4>
                    <figcaption>{{ $item->summary }}</figcaption>
                </figure>
                <a href="{{ route("frontend.catalog.detail", $item->slug) }}">Chi tiết</a>
            </li>
            @endif
        @endforeach
        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="Show more" data-title-hide="+"></span>
            </div>
            <a href="{{ route('frontend.product.all') }}"></a>
        </li>
    </ul>
</section>