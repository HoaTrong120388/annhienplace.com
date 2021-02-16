@extends('frontend.layouts.layout')
@section('headerstyle')
@endsection
@section('content')
@include('frontend.common.header-content', ['type' => 'blog'])
<section class="contact">
    <!-- === Goolge map === -->
    <div id="map"></div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-10 col-md-10">
                <div class="contact-block">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-map-marker"></span>
                                    <figcaption>
                                        <strong>Địa chỉ</strong>
                                        <span>{!! __('common.page_contact_address') !!}</span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-phone"></span>
                                    <figcaption>
                                        <strong>Hotline</strong>
                                        <span>
                                            {!! __('common.page_contact_phone') !!}
                                        </span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-sm-4">
                                <figure class="text-center">
                                    <span class="icon icon-clock"></span>
                                    <figcaption>
                                        <strong>Thời gian làm việc</strong>
                                        <span>
                                            {!! __('common.page_contact_timework') !!}
                                        </span>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="banner">
                        <div class="row justify-content-md-center">
                            <div class="col-md-offset-1 col-md-10 text-center">
                                {!! __('common.page_contact_content_form') !!}
                                <div class="contact-form-wrapper">
                                    <a class="btn btn-clean open-form" data-text-open="{{ __('common.open_form_contact') }}" data-text-close="{{ __('common.close_form_contact') }}">{{ __('common.open_form_contact') }}</a>
                                    <div class="contact-form clearfix">
                                        <form id="frm_contact" name="frm_contact" action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input name="fullname" type="text" value="" class="form-control" placeholder="Họ và tên" >
                                                        <span class="frm_error error_fullname"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input name="phone" type="text" value="" class="form-control" placeholder="Điện thoại" >
                                                        <span class="frm_error error_phone"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input name="email" type="email" value="" class="form-control" placeholder="Email" >
                                                        <span class="frm_error error_email"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control" placeholder="Nội dung liên hệ" rows="5"></textarea>
                                                        <span class="frm_error error_message"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" id="btn_submit_frm_contact" class="btn btn-clean">Gửi</button>
                                                </div>
                                            </div>
                                            @csrf
                                            <div class="loading_savefie" id="loading_savefie"><div class="loading_savefie_cnt"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--col-sm-8-->
        </div> <!--/row-->
    </div><!--/container-->
</section>
@endsection
@section('footerjs')
    <script>
        $(document).ready(function() {
            $("#frm_contact").validate({
                rules: {
                    fullname: {
                        required: true
                    },
                    message: {
                        required: true,
                        minlength: 10,
                        maxlength: 5000
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 9,
                        maxlength: 11
                    },
                },
                messages: {
                    fullname: {
                        required: 'Không được để trống'
                    },
                    message: {
                        required: 'Không được để trống',
                        minlength: 'Ít nhất 10 ký tự',
                        maxlength: 'Tối đa 1.000 ký tự',
                    },
                    phone: {
                        required: 'Không được để trống',
                        number: 'Phải là số',
                        minlength: 'Không đúng chuẩn',
                        maxlength: 'Không đúng chuẩn',
                    },
                },
                errorPlacement: function(error, element) {
                    var name = element.attr("name");
                    $(".error_"+name).text(error.html());
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
                success: function(element) {
                    $(element).closest('div.form-group').find('.frm_error').html('');
                },
                submitHandler: function (form) {
                    $("#loading_savefie").show();
                    var objForm = $("#frm_contact");
                    var objBtn = $("#btn_submit_frm_contact");
                    objBtn.prop('disabled', true);
                    $.ajax({
                        url: '{{ route("frontend.contact.submit") }}',
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
                                useBootstrap: false,
                                boxWidth: '90%',
                                buttons: {
                                    ok: function () {
                                        
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
                                useBootstrap: false,
                                boxWidth: '90%',
                                buttons: {
                                    ok: function () {
                                        objBtn.prop('disabled', false);
                                    }
                                }
                            });
                        }
                        $("#loading_savefie").hide();
                    });
                    return false;
                }
            });
        });
    </script>
    
    <script>
        function initMap() {
            var contentString ='{!! __('common.contact_info_popup') !!}';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            var myLatLng = { {{ __('common.contact_toa_do_map') }} };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng,
                styles: [{ "featureType": "administrative", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -100 }, { "lightness": 20 }] }, { "featureType": "road", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -100 }, { "lightness": 40 }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "visibility": "on" }, { "saturation": -10 }, { "lightness": 30 }] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [{ "visibility": "simplified" }, { "saturation": -60 }, { "lightness": 10 }] }, { "featureType": "landscape.natural", "elementType": "all", "stylers": [{ "visibility": "simplified" }, { "saturation": -60 }, { "lightness": 60 }] }, { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "off" }, { "saturation": -100 }, { "lightness": 60 }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }, { "saturation": -100 }, { "lightness": 60 }] }]
            });
            var image = '{{ asset("public/frontend/assets/images/map-icon.png") }}';
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: "Hello World!",
                icon: image
            });
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArqw5wYzzlt1BaIQybSuiqweXrHCZmqCw&callback=initMap"></script>
@endsection