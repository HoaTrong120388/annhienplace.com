<div class="col-sm-4 col-xs-6">
    <article>
        <a href="{{ route("frontend.post.detail", $item->slug) }}">
            <div class="image" style="background-image:url('{{ FCommon::cover_thumbnail($item->thumbnail) }}')">
                <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" width="360" />
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
        </a>
    </article>
</div>