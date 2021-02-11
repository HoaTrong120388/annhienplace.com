@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content', ['type' => 'blog'])
    <section class="blog">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-sm-10 col-md-8">
                    <div class="blog-post">
                        <!-- === blog main image & entry info === -->
                        <div class="blog-image-main">
                            <img src="{{ FCommon::cover_thumbnail($rs['thumbnail']) }}" alt="{{ $rs['title'] }}" />
                        </div>
                        <div class="blog-post-content">
                            <!-- === blog post title === -->
                            <div class="blog-post-title">
                                <h1 class="blog-title">
                                    {{ $rs['title'] ?? '' }}
                                </h1>
                                <h2 class="blog-subtitle h5">
                                    {!! $rs['summary'] ?? '' !!}
                                </h2>
                                <div class="blog-info blog-info-top">
                                    <div class="entry">
                                        <i class="fa fa-user"></i>
                                        <span>{{ $arrResult->authr->fullname ?? 'Admin' }}</span>
                                    </div>
                                    <div class="entry">
                                        <i class="fa fa-calendar"></i>
                                        <span>{{ Carbon::parse($rs['created_at'])->format('d M Y') }}</span>
                                    </div>
                                    <div class="entry">
                                        <i class="fa fa-comments"></i>
                                        <span>{{ $rs['comment_count'] ?? 0 }} comments</span>
                                    </div>
                                </div> <!--/blog-info-->
                            </div>
                            <!-- === blog post text === -->
                            <div class="blog-post-text">
                                {!! $rs['content'] !!}
                            </div>

                        </div>

                        <!-- === blog comments === -->
                        <div class="comments">
                            <!-- === comment header === -->
                            <div class="comment-header">
                                <ul class="social-share">
                                    @include('frontend.common.social-icon-share')
                                </ul>
                            </div>
                        </div>
                    </div><!--blog-post-->
                </div><!--col-sm-8-->
            </div> <!--/row-->
        </div><!--/container-->
    </section>
@endsection