<!-- ========================  Blog ======================== -->
<section class="blog">
    <div class="container">
        <!-- === blog header === -->
        <header>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! __('common.home_news_title') !!}
                </div>
            </div>
        </header>
        <div class="row">
            @foreach ($home_news as $item)
            <div class="col-sm-4">
                <article>
                    <a href="{{ route("frontend.post.detail", $item->slug) }}">
                        <div class="image" style="background-image:url('{{ FCommon::cover_thumbnail($item->thumbnail) }}')">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="{{ $item->title }}" />
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
                        <div class="show-more">
                            <span class="btn btn-main btn-block">Xem chi tiết</span>
                        </div>
                    </a>
                </article>
            </div>
            @endforeach
        </div> <!--/row-->
        <!-- === button more === -->
        <div class="wrapper-more">
            <a href="blog-grid.html" class="btn btn-main">Xem tất cả</a>
        </div>
    </div> <!--/container-->
</section>