@extends('frontend.layout')
@section('headerstyle')

@endsection
@section('content')
<header class="inner-header">
    <div class="container">
    <div class="col-sm-6 col-md-6">
        @include('frontend.common.breadcrumb')
        <h1>{{ $arrResult['title'] or '' }}</h1>
    </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="life-style-post-text grid2">
                                    <div class="row">
                                        <div class="col-md-12 contact-info">
                                            <div class="img-icon">
                                                <img src="{{ URL::asset('public/frontend/assets/img/phone-icon.png') }}" alt="phone-icon"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <span>Phone 01:</span> {{ $setting_result['company_phone'] }}
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <span>Phone 02:</span> {{ $setting_result['company_phone_2'] }}
                                                </div>
                                            </div>
                                            <div class="img-icon">
                                                <img src="{{ URL::asset('public/frontend/assets/img/email-icon.png') }}" alt="phone-icon"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <span>Tel:</span> {{ $setting_result['company_email'] }}
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <span>Email:</span> {{ $setting_result['company_email_2'] }}
                                                </div>
                                            </div>
                                            <div class="img-icon">
                                                <img src="{{ URL::asset('public/frontend/assets/img/address-icon.png') }}" alt="phone-icon"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span>Address 01:</span> {{ $setting_result['company_address'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- .blog-text -->
                                            <div class="blog-text-post">
                                                <!-- .comments -->
                                                <div id="comments" class="comments-area">
                                                    <div id="respond" class="comment-respond">
                                                        <h3 id="reply-title" class="comment-reply-title"><span>{{ __("common.contact_page_title_header_form") }}</span></h3>
                                                        <form action="" method="post" id="commentform" class="comment-form">
                                                            <p class="comment-form-author">
                                                                <input id="author" name="fullname" value="" size="30" placeholder="{{ __("common.contact_page_form_fullname") }}" type="text">
                                                            </p>
                                                            <p class="comment-form-email">
                                                                <input id="email" name="email" value="" size="30" placeholder="{{ __("common.contact_page_form_email") }}" type="text">
                                                            </p>
                                                            <p class="comment-form-email">
                                                                <input id="email" name="phone" value="" size="30" placeholder="{{ __("common.contact_page_form_phone") }}" type="text">
                                                            </p>
                                                            <p class="comment-form-comment">
                                                                <textarea id="comment" name="message" cols="45" rows="8" placeholder="{{ __("common.contact_page_form_message") }}" aria-required="true"></textarea>
                                                            </p>
                                                            <p class="form-submit">
                                                                <button type="button">
                                                                    <span id="btn-submit-contact">{{ __("common.contact_page_form_btn_send") }}</span>
                                                                    <div class="filter-spinner-loading">
                                                                        <div class="spinner">
                                                                            <div class="rect1"></div>
                                                                            <div class="rect2"></div>
                                                                            <div class="rect3"></div>
                                                                            <div class="rect4"></div>
                                                                            <div class="rect5"></div>
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </p>
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (isset($setting_result['banner_header_status']) && $setting_result['banner_header_status'] == 1)
                                        <div class="ad-banner">
                                            <img src="{{ FCommon::cover_thumbnail($setting_result['banner_header']) }}" alt="ad-banner"/>
                                        </div>
                                        @endif
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
</section>
@endsection

@section('footerjs')
    <script>
        $(document).ready(function() {
            $("#btn-submit-contact").on('click', function(){
                var obj = $(this);
                obj.next('.filter-spinner-loading').show();
                $.ajax({
                    url: '{{ route('frontend.contact.submit') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $("#commentform").serialize(),
                })
                .done(function(response) {
                    if(response.status == 1){
                        $.confirm({
                            title: '{{ __("common._noti_header_title_success") }}',
                            content: response.msg,
                            type: 'green',
                            animation: 'zoom',
                            closeAnimation: 'scale',
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
                            buttons: {
                                ok: function () {
                                    obj.next('.filter-spinner-loading').hide();
                                }
                            }
                        });
                    }
                })
                .fail(function(error) {
                    console.log("error");
                });

            });
        });
    </script>
@endsection