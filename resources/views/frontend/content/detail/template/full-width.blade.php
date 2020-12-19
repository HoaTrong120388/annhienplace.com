<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" data-category="1, 5" data-sort="Busy streets">
                        <!-- .grid -->
                        <div class="life-style-post-text grid2 pg-detail">
                            @if (isset($imagePage_Seo) && !empty($imagePage_Seo))
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ FCommon::cover_thumbnail($imagePage_Seo) }}" alt=""/>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="blog-text-post">
                                        <h1><a href="javascript:void(0);"><i class="fas fa-calendar"></i> {{ $arrResult['title'] or '' }}</a></h1>
                                        <span class="post-date">{{ Carbon::parse($arrResult['created_date'])->format('jS F Y') }}  |  by Admin</span>
                                        {!! $arrResult['content'] or '' !!}

                                        {{-- <div class="blog-tags-social row">
                                            <div class="blog-social col-sm-12 col-md-12">
                                                <ul class="social-list">
                                                    <li class="box"><a href="#"><i class="fad fa-facebook"></i></a></li>
                                                    <li class="box"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li class="box"><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                                    <li class="box"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li class="box"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>