<div class="col-md-4 col-xs-6">
    <article>
        <div class="figure-block">
            <div class="image">
                <a href="{{ route("frontend.catalog.detail", $item->slug) }}">
                    <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" width="360" />
                </a>
            </div>
            <div class="text">
                <h2 class="title h4"><a href="{{ route("frontend.catalog.detail", $item->slug) }}">{{ $item->title }}</a></h2>
                {{-- <sup></sup> --}}
                <span class="description clearfix">{!! $item->summary !!}</span>
            </div>
        </div>
    </article>
</div>