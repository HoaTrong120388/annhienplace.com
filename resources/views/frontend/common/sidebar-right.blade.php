<!-- .right content -->
<div class="col-sm-4 col-md-4">
    <section class="add">
        @if (isset($setting_result['banner_sidebar_right_status']) && $setting_result['banner_sidebar_right_status'] == 1)
        <div class="col-md-12 border">
            <img src="{{ FCommon::cover_thumbnail($setting_result['banner_sidebar_right']) }}" alt="ad-banner"/>
        </div>
        @endif
    </section>
    <section class="most-popular">
        <!-- .title -->
        <div class="title">
            <h2>{{ __('common.nav_student_corner') }}</h2>
        </div>
        <!-- /.title -->
        <!-- .most-popular-carousel -->
        <div class="owl-carousel owl-theme carousel">
            <div>
                @foreach ($lst_sidebar_studentcorner['group_1'] as $item)
                <div class="weghiet">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 small-thumbnail">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '100x70') }}" alt="{{ $item->title }}">
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h4><a href="{{ route('frontend.post.detail', $item->slug) }}">{{ $item->title }}</a></h4>
                            <span class="post-date">Posted On {{ Carbon::parse($item->created_date)->format('jS, F Y') }}</span>
                            <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                @foreach ($lst_sidebar_studentcorner['group_2'] as $item)
                <div class="weghiet">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 small-thumbnail">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '100x70') }}" alt="{{ $item->title }}">
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h4><a href="{{ route('frontend.post.detail', $item->slug) }}">{{ $item->title }}</a></h4>
                            <span class="post-date">Posted On {{ Carbon::parse($item->created_date)->format('jS, F Y') }}</span>
                            <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.weghiet -->
                @endforeach
            </div>
        </div>
        <!-- /.most-popular-carousel -->
    </section>
    <section class="latest-reviews">
        <!-- .title -->
        <div class="title">
            <h2>{{ __('common.nav_news_event') }}</h2>
        </div>
        <!-- /.title -->
        <!-- .latest-reviews-carousel -->
        <div class="owl-carousel owl-theme carousel">
            <div>
                @foreach ($lst_sidebar_news['group_1'] as $item)
                <div class="weghiet">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 small-thumbnail">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '100x70') }}" alt="{{ $item->title }}">
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h4><a href="{{ route('frontend.post.detail', $item->slug) }}">{{ $item->title }}</a></h4>
                            <span class="post-date">Posted On {{ Carbon::parse($item->created_date)->format('jS, F Y') }}</span>
                            <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div>
                @foreach ($lst_sidebar_news['group_2'] as $item)
                <div class="weghiet">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 small-thumbnail">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '100x70') }}" alt="{{ $item->title }}">
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <h4><a href="{{ route('frontend.post.detail', $item->slug) }}">{{ $item->title }}</a></h4>
                            <span class="post-date">Posted On {{ Carbon::parse($item->created_date)->format('jS, F Y') }}</span>
                            <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.weghiet -->
                @endforeach
            </div>
        </div>
        <!-- /.latest-reviews-carousel -->
    </section>
    <section class="add">
        @if (isset($setting_result['home_youtube']) && !empty($setting_result['home_youtube']))
        <div class="col-md-12 border">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $setting_result['home_youtube'] }}?rel=0" allowfullscreen></iframe>
            </div>
        </div>
        @endif
    </section>
</div>
<!-- /.right content -->