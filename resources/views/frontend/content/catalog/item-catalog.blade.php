<div class="col-sm-4">
    <article>
        <a href="{{ route("frontend.post.detail", $item->slug) }}">
            <div class="image" style="background-image:url({{ FCommon::cover_thumbnail($item->thumbnail) }})">
                <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="" />
            </div>
            <div class="entry entry-block">
                <div class="date">{{ Carbon::parse($item->created_at)->format('d M Y') }}</div>
                <div class="title">
                    <h2 class="h5">{{ $item->title }}</h2>
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