@extends('frontend.layouts.layout')
@section('content')
    @include('frontend.common.header-content', ['type' => 'blog'])
    <section class="blog">
        @if (!empty($rs['album']))
        <div class="container" id="container" style="text-align: center;display: flex;flex-flow: column nowrap;justify-content: center;align-items: center;">
            <div id="catalog">
                @foreach ($rs['album'] as $alb)
                    <div>
                        <img src="{{ FCommon::cover_thumbnail($alb) }}" alt="{{ $rs['title'] }}" />
                    </div>
                @endforeach
            </div>
            <div class="mt-5"></div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a  class="page-link" id='first'      href="javascript:void(0);" title=''><i class="fa fa-fast-backward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='back'       href="javascript:void(0);" title=''><i class="fa fa-backward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='next'       href="javascript:void(0);" title=''><i class="fa fa-forward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='last'       href="javascript:void(0);" title=''><i class="fa fa-fast-forward"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='zoomout'    href="javascript:void(0);" title=''><i class="fa fa-search-minus"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='zoomin'     href="javascript:void(0);" title=''><i class="fa fa-search-plus"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='slideshow'  href="javascript:void(0);" title=''><i class="fa fa-play"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='flipsound'  href="javascript:void(0);" title=''><i class="fa fa-volume-up"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='fullscreen' href="javascript:void(0);" title=''><i class="fa fa-expand"></i></a></li>
                    <li class="page-item"><a  class="page-link" id='thumbs'     href="javascript:void(0);" title=''><i class="fa fa-th"></i></a></li>
                </ul>
            </nav>
        </div>
        @endif
    </section>
@endsection

@section('headerstyle')
    <link rel="stylesheet" href="{{ asset('public/all/plugin/wowbook/css/wow_book.css') }}">
@endsection
@section('footerjs')
    <script src="{{ asset('public/all/plugin/wowbook/js/wow_book.js') }}"></script>
    <script type="text/javascript"> 
        $(document).ready(function () {
            $('#catalog').wowBook({
                height : 400,
                width  : 600,
                flipSound: false,
                centeredWhenClosed : true,
                hardcovers : true,
                turnPageDuration : 1000,
                numberedPages : [1,-2],
                controls : {
                    zoomIn    : '#zoomin',
                    zoomOut   : '#zoomout',
                    next      : '#next',
                    back      : '#back',
                    first     : '#first',
                    last      : '#last',
                    slideShow : '#slideshow',
                    flipSound : '#flipsound',
                    thumbnails : '#thumbs',
                    fullscreen : '#fullscreen'
                },
                scaleToFit: "#container",
                thumbnailsPosition : 'bottom'
            });
        });
    </script>
@endsection
