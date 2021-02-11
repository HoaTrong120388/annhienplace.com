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
                                    <a class="btn btn-clean open-form" data-text-open="Contact us via form" data-text-close="Close form">Contact us via form</a>
                                    <div class="contact-form clearfix">
                                        <form id="sendmail" name="sendmail" action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input id="Name" name="Name" type="text" value="" class="form-control" placeholder="Your name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input id="Email" name="Email" type="email" value="" class="form-control" placeholder="Your email" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input id="Subject" name="Subject" type="text" value="" class="form-control" placeholder="Subject" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea id="Comment" name="Comment" class="form-control" placeholder="Your message" rows="10"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <input type="submit" class="btn btn-clean" value="Send message" />
                                                </div>
                                            </div>
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