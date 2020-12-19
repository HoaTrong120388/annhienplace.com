@extends('frontend.landingpage.layout')
@section('content')
<header class="landingpage_header">
    <div class="container">
        <div class="header_top">
            <div class="header_logo">
                <a href="">
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/logo.png?v=0.1") }}" alt="">
                </a>
            </div>
            <div class="header_top_content">
                <div class="header_topbar">
                    <ul>
                        <li><a target="_blank" href="tel:{{ $setting_result['company_phone'] ?? '' }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/hotline.png") }}" alt=""></a></li>
                        <li><a target="_blank" href="{{ $setting_result['social_fanpage'] ?? '' }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/icon-fb.png") }}" alt=""></a></li>
                        <li><a target="_blank" href="{{ $setting_result['social_youtube'] ?? '' }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/icon-youtube.png") }}" alt=""></a></li>
                    </ul>
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/title-header.png") }}" alt="">
                </div>
            </div>
        </div>
        <div class="header_nav_mobile">
            <div class="icon_nav_mobile">
                <a href="javascript:void(0);">
                    <span>
                        <em></em>
                        <em></em>
                        <em></em>
                    </span>
                </a>
                <ul class="close">
                    <li><a class="nav_landingpage frame_1" href="javascript:void(0);" data-frame="frame_1">Trang Chủ</a></li>
                    <li><a class="nav_landingpage frame_2" href="javascript:void(0);" data-frame="frame_2">Giới thiệu</a></li>
                    <li><a class="nav_landingpage frame_3" href="javascript:void(0);" data-frame="frame_3">Ưu đãi</a></li>
                    <li><a class="nav_landingpage frame_4" href="javascript:void(0);" data-frame="frame_4">Video & Hình ảnh</a></li>
                    <li><a class="nav_landingpage frame_5" href="javascript:void(0);" data-frame="frame_5">Bác sĩ</a></li>
                    <li><a class="nav_landingpage frame_6" href="javascript:void(0);" data-frame="frame_6">Khách hàng</a></li>
                </ul>
            </div>
            <ul>
                <li><a target="_blank" href="{{ $setting_result['social_fanpage'] ?? '' }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/icon-fb.png") }}" alt=""></a></li>
                <li><a target="_blank" href="{{ $setting_result['social_youtube'] ?? '' }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/icon-youtube.png") }}" alt=""></a></li>
            </ul>
        </div>
        <div class="header_nav">
            <ul>
                <li><a class="nav_landingpage frame_1" href="javascript:void(0);" data-frame="frame_1"><img class="lazyload" data-src="{{  asset("$path_public_landingpage/images/home.png")  }}" alt=""></a></li>
                <li><a class="nav_landingpage frame_2" href="javascript:void(0);" data-frame="frame_2">Giới thiệu</a></li>
                <li><a class="nav_landingpage frame_3" href="javascript:void(0);" data-frame="frame_3">Ưu đãi</a></li>
                <li><a class="nav_landingpage frame_4" href="javascript:void(0);" data-frame="frame_4">Video & Hình ảnh</a></li>
                <li><a class="nav_landingpage frame_5" href="javascript:void(0);" data-frame="frame_5">Bác sĩ</a></li>
                <li><a class="nav_landingpage frame_6" href="javascript:void(0);" data-frame="frame_6">Khách hàng</a></li>
            </ul>
        </div>
    </div>
</header>
<main>
    <section class="landingpage_content">
        <div class="header_banner" id="frame_1">
            <a href="javascript:void(0);">
                @if ($is_mobile == 1)
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-31.jpg") }}" alt="">
                @else
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-29.jpg") }}" alt="">
                @endif
            </a>
        </div>
        <div class="content_full" id="frame_2">
            <a href="javascript:void(0);">
                @if ($is_mobile == 1)
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-35.jpg") }}" alt="">
                @else
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-34.jpg") }}" alt="">
                @endif
            </a>
        </div>
        <div class="content_full">
            <div class="content_row">
                <div class="content-left">
                    <a data-fancybox="about" href="{{ asset("$path_public_landingpage") }}/images/about/@if ($is_mobile == 1){{ 'mobile' }}@else{{ 'pc' }}@endif.jpg") }}">
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/noi-that/09.jpeg") }}" alt="">
                    </a>
                </div>
                <div class="content-right">
                    <a href="javascript:void(0);">
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-30.jpg") }}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="content_full">
            <a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-5.jpg") }}" alt=""></a>
        </div>
        <div class="content_full" id="frame_3">
            <div class="content_row content_service">
                <div class="content_service_left">
                    <a href="javascript:void(0);">
                        @if ($is_mobile == 1)
                            <img class="lazyload" data-src="images/landing-page-41.jpg" alt="">
                        @else
                            <img class="lazyload" data-src="images/landing-page-40.jpg" alt="">
                        @endif
                    </a>
                </div>
                <div class="content_service_right">
                    <ul class="list_service">
                        @for ($i = 1; $i < 7; $i++)
                        <li>
                            <a class="popup-service" href="javascript:void(0);" data-src="{{ asset("$path_public_landingpage") }}/images/popup-dich-vu-@if ($is_mobile == 1){{ 'mobile' }}@else{{ 'pc' }}@endif-0{{ $i }}.jpg?v=0.1">
                                <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/uu-dai-dac-biet-$i.png") }}" alt="">
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
                <div class="content_service_full">
                    <ul class="list_service">
                        @for ($i = 7; $i < 11; $i++)
                        <li>
                            <a class="popup-service" href="javascript:void(0);" data-src="{{ asset("$path_public_landingpage") }}/images/popup-dich-vu-@if ($is_mobile == 1){{ 'mobile' }}@else{{ 'pc' }}@endif-0{{ $i }}.jpg?v=0.2">
                                <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/uu-dai-dac-biet-$i.png") }}" alt="">
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="content_full" id="frame_4">
            <a href="javascript:void(0);">
                @if ($is_mobile == 1)
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-14.png") }}" alt="">
                @else
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-7.jpg") }}" alt="">
                @endif
            </a>
        </div>
        <div class="content_full">
            <div class="content_row flex-row jc-sp-ce">
                <div class="content_50p pr-5x ele-flex-col">
                    <a class="no-height" href="https://www.youtube.com/channel/UC0B-1rbjFyxtpDj66DhoNeQ" target="_blank"><img class="no-height" src="{{ asset("$path_public_landingpage/images/landing-page-15.png") }}" alt=""></a>
                    <ul class="list-video-thumb">
                        <li><a href="https://www.youtube.com/channel/UC0B-1rbjFyxtpDj66DhoNeQ" target="_blank"><img class="no-height" src="{{ asset("$path_public_landingpage/images/landing-page-17.png") }}" alt=""></a></li>
                        <li><a href="https://www.youtube.com/channel/UC0B-1rbjFyxtpDj66DhoNeQ" target="_blank"><img class="no-height" src="{{ asset("$path_public_landingpage/images/landing-page-18.png") }}" alt=""></a></li>
                        <li><a href="https://www.youtube.com/channel/UC0B-1rbjFyxtpDj66DhoNeQ" target="_blank"><img class="no-height" src="{{ asset("$path_public_landingpage/images/landing-page-19.png") }}" alt=""></a></li>
                    </ul>
                </div>
                <div class="content_50p pl-5x">
                    <a class="no-height show_lst_b_a" href="javascript:void(0);">
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/b-a/thumb-3.jpg") }}" alt="">
                    </a>
                    <ul class="list-video-thumb">
                        <li><a class="show_lst_b_a" href="javascript:void(0);"><img class="no-height" src="{{ asset("$path_public_landingpage/images/b-a/thumb-1.jpg") }}" alt=""></a></li>
                        <li><a class="show_lst_b_a" href="javascript:void(0);"><img class="no-height" src="{{ asset("$path_public_landingpage/images/b-a/thumb-2.jpg") }}" alt=""></a></li>
                        <li><a class="show_lst_b_a" href="javascript:void(0);"><img class="no-height" src="{{ asset("$path_public_landingpage/images/b-a/thumb-4.jpg") }}" alt=""></a></li>
                    </ul>
                    {{-- <div class="owl-carousel owl-theme" id="owl-b-a">
                        @for ($i = 1; $i < 6; $i++)
                        <div class="item">
                            <a data-fancybox="b-a" href="{{ asset("$path_public_landingpage/images/b-a/0$i.jpg") }}">
                                <img class="owl-lazy" data-src="{{ asset("$path_public_landingpage/images/b-a/0$i.jpg") }}" alt="">
                            </a>
                        </div>
                        @endfor
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="content_full" id="frame_5">
            <a href="javascript:void(0);">
                @if ($is_mobile == 1)
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-8.jpg") }}" alt="">
                @else
                    <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-2.jpg") }}" alt="">
                @endif
            </a>
        </div>
        <div class="content_full">
            <div class="content_row flex-row jc-sp-ce">
                <div class="content_50p pl-2x">
                    @if ($is_mobile == 1)
                    <a data-fancybox="bacsi" href="{{ asset("$path_public_landingpage/images/bac-si/05.jpg") }}">
                    @else
                    <a data-fancybox="bacsi" href="{{ asset("$path_public_landingpage/images/bac-si/06.jpg") }}">
                    @endif
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/bac-si/02.png") }}" alt="">
                    </a>
                </div>
                <div class="content_50p pr-2x">
                    @if ($is_mobile == 1)
                    <a data-fancybox="bacsi" href="{{ asset("$path_public_landingpage/images/bac-si/03.jpg") }}">
                    @else
                    <a data-fancybox="bacsi" href="{{ asset("$path_public_landingpage/images/bac-si/04.jpg") }}">
                    @endif
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/bac-si/01.png") }}" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="content_full" id="frame_6">
            @if ($is_mobile == 1)
            <a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-33.jpg") }}" alt=""></a>
            @else
            <a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-32.jpg") }}" alt=""></a>
            @endif
            <div class="content_feedback">
                <div class="owl-carousel owl-theme" id="owl-feedback">
                    @for ($i = 1; $i < 5; $i++)
                    <div class="item">
                        <a data-fancybox="b-a" href="{{ asset("$path_public_landingpage") }}/images/feedback/@if ($is_mobile == 1){{ 'mobile' }}@else{{ 'pc' }}@endif-{{ $i }}.jpg">
                            <img class="owl-lazy" data-src="{{ asset("$path_public_landingpage") }}/images/feedback/@if ($is_mobile == 1){{ 'mobile' }}@else{{ 'pc' }}@endif-{{ $i }}.jpg" alt="">
                        </a>
                    </div>
                    @endfor
                </div>
                <ul class="feedback-dots" id="feedback-dots">
                    @for ($i = 1; $i < 5; $i++)
                    <li class=" @if ($i == 1) active @endif " >
                        <a href="javascript:void(0);">
                            <img src="{{ asset("$path_public_landingpage") }}/images/feedback/mobile-{{ $i }}.jpg" alt="">
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="content_full">
            @if ($is_mobile == 1)
            <a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-9.jpg") }}" alt=""></a>
            @else
            <a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-10.jpg") }}" alt=""></a>
            @endif
            <div class="showroom">
                <div class="col-50">
                    <a data-fancybox="showroom" href="{{ asset("$path_public_landingpage/images/noi-that/01.jpeg") }}">
                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/noi-that/01.jpeg") }}" alt="">
                    </a>
                </div>
                <div class="col-50">
                    <ul>
                        @for ($i = 2; $i < 6; $i++)
                        <li><a data-fancybox="showroom" href="{{ asset("$path_public_landingpage/images/noi-that/0$i.jpeg") }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/noi-that/0$i.jpeg") }}" alt=""></a></li>
                        @endfor
                    </ul>
                </div>
                <div class="all_showroom" style="display: none">
                    @for ($i = 6; $i < 12; $i++)
                    <a data-fancybox="showroom" href="{{ asset("$path_public_landingpage/images/noi-that/0$i.jpeg") }}"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/noi-that/0$i.jpeg") }}" alt=""></a>
                    @endfor
                </div>
            </div>
        </div>
        <div class="content_full">
            <div class="form_register_landingpage">
                <h3>form đăng ký</h3>
                <div class="form_register_content">
                    <div class="content_row">
                        <div class="content_60p"><a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-24.png") }}" alt=""></a></div>
                        <div class="content_40p">
                            <form action="" method="post">
                                <div class="frm_control">
                                    <input name="fullname" placeholder="{{ __("landingpage.contact_page_form_fullname") }}" type="text">
                                </div>
                                <div class="frm_control">
                                    <input name="phone" placeholder="{{ __("landingpage.contact_page_form_phone") }}" type="text">
                                </div>
                                <div class="frm_control">
                                    <input name="email" placeholder="{{ __("landingpage.contact_page_form_email") }}" type="text">
                                </div>
                                <div class="frm_control">
                                    <textarea name="content" placeholder="{{ __("landingpage.contact_page_form_content") }}"></textarea>
                                </div>
                                <div class="frm_button">
                                    <button type="button" class="submit_register">
                                        <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/tu-van-mien-phi.png") }}" alt="">
                                    </button>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer class="landingpage-footer">
    <div class="footer_top">
        @if ($is_mobile == 1)
            <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-39.jpg") }}" alt="">
        @else
            <img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/landing-page-38.jpg") }}" alt="">
        @endif
    </div>
    <div class="container">
        <div class="footer_div_center"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/address.png") }}" alt=""></div>
        <ul>
            <li><a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/footer-icon_01.png") }}" alt=""></a></li>
            <li><a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/footer-icon_03.png") }}" alt=""></a></li>
            <li><a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/footer-icon_05.png") }}" alt=""></a></li>
        </ul>
    </div>
</footer>
<section class="sticky_nav">
    <div class="container">
        <ul>
            <li><a href="tel:0909896668"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/flat-icon-call.png") }}" alt=""></a></li>
            <li><a href="javascript:void(0);" class="register_contact"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/flat-icon-register.png") }}" alt=""></a></li>
            <li><a href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/flat-icon-chat.png") }}" alt=""></a></li>
        </ul>
        <a class="backtop" href="javascript:void(0);"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/flat-icon-home.png") }}" alt=""></a>
    </div>
</section>
<div class="popup_severice_thumb" id="popup_severice_thumb">
    <div class="header_popup"></div>
    <div class="content_popup">
        <a href="javascript:void(0);" class="register_contact">
            <img class="cnt_service" src="" alt="">
            <button class="btn_register_now"><img class="lazyload" data-src="{{ asset("$path_public_landingpage/images/tu-van-mien-phi.png") }}" alt=""></button>
        </a>
    </div>
    <div class="footer_popup"></div>
</div>
@endsection


@section('js_popup_register')
<script>
    $(document).ready(function () {
        $(".submit_register").on('click', function(){
            var objBtn = $(this);
            var objForm = objBtn.closest("form");
            objBtn.prop('disabled', true);
            $.ajax({
                url: '{{ route('frontend.landingpgae.register.submit') }}',
                type: 'POST',
                dataType: 'json',
                data: objForm.serialize(),
            })
            .done(function(response) {
                if(response.status == 1){
                    objForm.trigger('reset');
                    $.confirm({
                        title: '{{ __("common._noti_header_title_success") }}',
                        content: response.msg,
                        type: 'green',
                        animation: 'zoom',
                        closeAnimation: 'scale',
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                                location.reload();
                            }
                        }
                    });
                }else{
                    $.confirm({
                        title: '{{ __("common._noti_header_title_error") }}',
                        content: response.list_error,
                        type: 'red',
                        animation: 'zoom',
                        closeAnimation: 'scale',
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                                objBtn.prop('disabled', false);
                            }
                        }
                    });
                }
            })
            .fail(function(error) {
                console.log("error");
            });
        });
        $(".popup-service").on('click', function(e){
            e.preventDefault();
            var data_src = $(this).data("src");
            console.log(data_src);
            $(".cnt_service").attr('src', data_src);
            $.fancybox.open({
                'src': "#popup_severice_thumb"
            });
        });

        var sli_feedback = $('#owl-feedback').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots:false,
            items:1,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            lazyLoad: true,
            dotsContainer: '#feedback-dots'
        });
        $('#feedback-dots li').click(function (e) {
            e.preventDefault();
            console.log($(this).index());
            sli_feedback.trigger('to.owl.carousel', [$(this).index(), 300]);
        });
        sli_feedback.on('changed.owl.carousel', function(e) {
            console.log("test");
            var index_owl = e.item.index - 2;
            $('#feedback-dots li').removeClass('active');
            $('#feedback-dots li:eq('+index_owl+')').addClass('active');
        });
        $('[data-fancybox="showroom"]').fancybox({
            thumbs : {
                autoStart : true
            }
        });
        $(".show_lst_b_a").on('click', function(){
            $.fancybox.open(
                [
                    @for ($i = 1; $i < 8; $i++)
                    {
                        src  : '{{ asset("$path_public_landingpage/images/b-a/0$i.jpg") }}',
                        opts : {
                            thumb   : '{{ asset("$path_public_landingpage/images/b-a/0$i.jpg") }}'
                        }
                    } @if($i < 8),@endif
                    @endfor
                ],{
                    thumbs : {
                        autoStart : true
                    }
                }
            );
        });
    });
</script>
@endsection