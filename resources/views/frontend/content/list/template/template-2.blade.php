@if (!empty($lstNews) && count($lstNews) > 0)
<div class="container">
    <div class="col-md-12 filtr-container">
        <div class="row">
            @foreach ($lstNews as $item)
            <div class="col-sm-4 col-md-4 filtr-item">
                <div class="life-style-post-text grid2">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '370x280') }}" alt="grid-img1"/>
                        </div>
                        <div class="col-md-12">
                            <div class="blog-text">
                                <h3><a href="{{ route($route_news, $item->slug) }}">{{ $item->title }}</a></h3>
                                <span class="post-date"><i class="fas fa-calendar"></i> {{ Carbon::parse($item->created_date)->format('jS F Y') }}</span>
                                <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                                <p>{{  Str::limit(strip_tags($item->summary) , 200) }}</p>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            @if (($loop->iteration % 3) == 0) </div> <div class="row"> @endif
            @endforeach
        </div>
    </div>
</div>
@endif