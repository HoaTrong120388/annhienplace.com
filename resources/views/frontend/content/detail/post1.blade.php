@extends('frontend.layout.layout')
@section('content')
<main>
    <div class="header_banner">
        <img src="@if (isset($arrResult->more_info->header_banner_pc)) {{ FCommon::cover_thumbnail($arrResult->more_info->header_banner_pc) }}@endif" alt="{{ $arrResult->title ?? '' }}">
    </div>
    <section class="container">
        <div class="row">
            <div class="col-8 pg-detail">
                {!! $arrResult->content !!}
            </div>
            <div class="col-4">
                sd
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
@endsection