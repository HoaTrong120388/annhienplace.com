@extends('frontend.layout')
@section('headerstyle')
<style>
    .pdfobject-container { height: 700px;}
    .pdfobject { border: 1px solid #666; }
</style>
@endsection
@section('content')
@if (isset($page_about) && $page_about == 1)
<section class="ele_bg_video">
    <div class="video-background">
        <div class="video-foreground">
            <video autoplay muted loop id="myVideo">
                <source src="http://edugo.vn/wp-content/uploads/2019/09/getfvid_10000000_403646313842445_5174170281876942748_n.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    {{-- <div class="content_bg_video">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    @include('frontend.common.breadcrumb')
                    <h1>{{ $arrResult['title'] or '' }}</h1>
                </div>
            </div>
        </div>
    </div> --}}
    
</section>
@else
<header class="inner-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                @include('frontend.common.breadcrumb')
                <h1>{{ $arrResult['title'] or '' }}</h1>
            </div>
        </div>
    </div>
</header>
@endif
<section>
    @switch($arrResult['more_info']->template)
        @case(2)
            @include('frontend.content.detail.template.full-width')
            @break

        @default
            @include('frontend.content.detail.template.right-sidebar')
    @endswitch
</section>
@endsection

@section('footerjs')
@endsection