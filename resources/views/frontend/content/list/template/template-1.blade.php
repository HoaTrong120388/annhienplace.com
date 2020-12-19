<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-8">
            <div class="row">
                <div class="col-md-12 filtr-container">
                    @if (!empty($lstNews) && count($lstNews) > 0)
                    <div class="row">
                        @foreach ($lstNews as $item)
                            <div class="col-sm-6 col-md-6 filtr-item" data-category="1, 5" data-sort="Busy streets">
                                <div class="life-style-post-text grid2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ FCommon::cover_thumbnail($item->thumbnail, '370x280') }}" alt="grid-img1"/>
                                            <div class="smalltitle">{{ $item->catalog_name or '' }}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="blog-text">
                                                <h3>
                                                    <a href="{{ route($route_news, $item->slug) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <span class="post-date"><i class="fas fa-calendar"></i> {{ Carbon::parse($item->created_date)->format('jS F Y') }}</span>
                                                <span class="post-comment"><i class="fa fa-eye" aria-hidden="true"></i> {{ $item->view }}</span>
                                                <p>{{  Str::limit(strip_tags($item->summary) , 200) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (($loop->iteration % 2) == 0) </div> <div class="row"> @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            {{-- <div class="pagetions">
                <div class="col-sm-2 col-md-2 text-left">
                <a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                </div>
                <div class="col-sm-8 col-md-8 text-center">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#" class="active">2</a></li>
                    <li><a href="#">3</a></li>
                </ul>
                </div>
                <div class="col-sm-2 col-md-2 text-right">
                <a href="#">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div> --}}
        </div>
        <!-- /.left content -->
        @include('frontend.common.sidebar-right')
    </div>
</div>