<div class="col-md-4 col-xs-6">
    <article>
        <div class="figure-grid">
            <div class="image">
                <a href="{{ route("frontend.post.detail", $item->slug) }}">
                    <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '350') }}" alt="{{ $item->title }}" width="360" />
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