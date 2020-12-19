<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-8">
            <div class="row">
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
                                        <!-- .blog-text -->
                                        <div class="blog-text-post">
                                            <h1><a href="{{ URL::current() }}">{{ $arrResult['title'] or '' }}</a></h1>
                                            <span class="post-date"><i class="fas fa-calendar"></i> {{ Carbon::parse($arrResult['created_date'])->format('jS F Y') }}  |  by Admin</span>
                                            {!! $arrResult['content'] or '' !!}

                                            @if (!empty($arrResult['filepdf']))
                                            {{ trans("common.detail_post_download_file") }}: <a target="_blank" href="{{ $arrResult['filepdf'] }}">Click here</a>
                                            <div class="embed-responsive embed-responsive-16by9" style="margin-bottom: 20px;">
                                                <iframe src="{{ $setting_result['website_domain'] }}/viewer.html?file={{ $arrResult['filepdf'] }}" frameborder="0"></iframe>
                                            </div>
                                            @endif
                                            <ul class="btn_contact_end_post">
                                                <li>
                                                    <a href="{{ $setting_result['company_facebook_chat'] or 'javascript:void(0)' }}" target="_blank">
                                                        <i class="fab fa-facebook-messenger"></i>
                                                        {{ trans("common.chat_facebook") }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="register_contact">
                                                        <i class="fas fa-clipboard"></i>
                                                        {{ trans("common.register_contact") }}
                                                    </a>
                                                </li>
                                            </ul>
                                            {{-- <div class="blog-tags-social row">
                                                <div class="blog-social col-sm-12 col-md-12">
                                                    <ul class="social-list">
                                                        <li class="box"><a href="#"><i class="fa fa-facebook"></i></a></li>
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
        @include('frontend.common.sidebar-right')
    </div>
</div>