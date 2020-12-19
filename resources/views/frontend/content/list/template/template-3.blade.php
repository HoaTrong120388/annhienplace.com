@if (!empty($lstNews) && count($lstNews) > 0)
<div class="container">
    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 360 }'>
        @foreach ($lstNews as $item)
        @if ($loop->iteration == 1)
        <div class="grid-item grid-item--width2">
            <div class="col-md-12">
               <!-- .life-style-post-text -->
                <div class="life-style-post-text grid2 gmag">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail) }}" alt="grid-img1"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="blog-text blog-mt">
                                <h3><a href="{{ route($route_news, $item->slug) }}">{{ $item->title }}</a></h3>
                                <span class="post-date"><i class="fas fa-calendar"></i> {{ Carbon::parse($item->created_date)->format('jS F Y') }}</span>
                                <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="grid-item">
                <div class="col-md-12">
                    <div class="life-style-post-text grid2 gmag">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '370x280') }}" alt="grid-img1"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="blog-text">
                                    <h3><a href="{{ route('frontend.post.detail', $item->slug) }}">{{ $item->title }}</a></h3>
                                    <span class="post-date">{{ Carbon::parse($item->created_date)->format('jS F Y') }}</span>
                                    <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                                    <p>{{  Str::limit(strip_tags($item->summary) , 200) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif


<script src="{{ asset('public/frontend/assets/js/masonry.min.js') }}"></script>