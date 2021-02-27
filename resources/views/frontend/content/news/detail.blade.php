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
                                        <span>{{ $rs['comemnt_count'] ?? 0 }} comments</span>
                                    </div>
                                    <div class="entry">
                                        <i class="fa fa-eye"></i>
                                        <span>{{ $rs['view_count'] ?? 0 }} views</span>
                                    </div>
                                </div> <!--/blog-info-->
                            </div>
                            <!-- === blog post text === -->
                            <div class="blog-post-text pg-detail">
                                {!! $rs['content'] !!}
                            </div>
                            
                            @include('frontend.common.info-contact')

                            @if (!empty($rs['tags']) && count($rs['tags']) > 0 )
                            <div class="blog-info blog-info-bottom">
                                <ul>
                                    <li class="divider"></li>
                                    <li>
                                        <i class="fa fa-tag"></i> 
                                        <span>
                                            @foreach ($rs['tags'] as $tag)
                                                @if ($rs['group'] == 3)
                                                    <a class="item-tags" href="{{ route("frontend.service.tags", urlencode($tag)) }}">
                                                @else
                                                    <a class="item-tags" href="{{ route("frontend.news.tags", urlencode($tag)) }}">
                                                @endif
                                                    {{ $tag }}@if (!$loop->last),@endif
                                                </a>
                                            @endforeach
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>

                        <!-- === blog comments === -->
                        <div class="comments">
                            <!-- === comment header === -->
                            <div class="comment-header">
                                <ul class="social-share">
                                    @include('frontend.common.social-icon-share')
                                </ul>
                            </div>
                            @if ($arrComment->count() > 0)
                            <div class="comment-wrapper">
                                @include('frontend.common.comment-list')
                            </div>
                            <div class="comment-header">
                                <a href="#" class="btn btn-clean-dark">{{ $arrComment->count() }} comments</a>
                            </div>
                            @endif
                            @include('frontend.common.form-comment')
                        </div>
                    </div><!--blog-post-->
                </div><!--col-sm-8-->
            </div> <!--/row-->
        </div><!--/container-->
    </section>
@endsection