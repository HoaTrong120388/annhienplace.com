<div class="col-sm-4">
    <article>
        <a href="{{ route("frontend.post.detail", $item->slug) }}">
            <div class="image">
                <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '360x470') }}" alt="{{ $item->title }}" />
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