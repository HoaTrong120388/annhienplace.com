<!DOCTYPE html>
<html>
<head>
    <base href="{{ asset('public/frontend/landingpage/coming-soon') }}/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="{{ $setting_result['company_fav_icon'] ?? '' }}" rel="shortcut icon" type="image/x-icon" />
    <title>{{ $titlePage_Seo }}</title>
    <meta name="description" content="{{ $keywordPage_Seo }}" />
    <meta name="keywords" content="{{ $descriptionPage_Seo }}">
    <meta name="author" content="{{ $setting_result['company_name'] ?? '' }}">
    <meta name="copyright" content="{{ $setting_result['company_name'] ?? '' }}">
    <meta name="robots" content="index, follow" />

    @if (isset($imagePage_Seo))
    <meta property="og:image" content="{{ $imagePage_Seo or '' }}"/>
    <meta content=1200 property=og:image:width>
    <meta content=630 property=og:image:height>
    @elseif(!empty($setting_result['company_image_cover_share']))
    <meta property="og:image" content="{{ $setting_result['company_image_cover_share'] or '' }}"/>
    <meta content=1200 property=og:image:width>
    <meta content=630 property=og:image:height>
    @endif


    <meta property="article:publisher" content="{{ $setting_result['social_fanpage'] or '' }}" />
    <meta property="article:author" content="{{ $setting_result['social_fanpage'] or '' }}"/>
    <meta property="og:site_name" content="{{ $descriptionPage_Seo }}" />
    <meta property="og:title" content="{{ $titlePage_Seo }}" />
    <meta property="og:description" content="{{ $keywordPage_Seo }}" />
    <meta property="og:updated_time" content="2019-10-01" />
    <meta property="og:type" content="article" />
    <meta property="og:og:locale" content="vi_vn" />
    


	<link rel="stylesheet" href="{{ asset('public/all/plugin/fancybox/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/all/plugin/owlcarousel/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/all/plugin/jquery-confirm/jquery-confirm.min.css') }}">
    <style>{!! file_get_contents( asset("$path_public_landingpage/style.min.css") ) !!}</style>

	<script src="{{ asset('public/all/plugin/jquery.min.js') }}"></script>
	<script src="{{ asset('public/all/plugin/fancybox/jquery.fancybox.min.js') }}"></script>
	<script src="{{ asset('public/all/plugin/owlcarousel/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('public/all/plugin/jquery-confirm/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('public/all/plugin/lazyload/lazysizes.min.js') }}"></script>

    <script>
        var path_public             = "{{ asset('public') }}";
        var path_upload             = "{{ asset('upload') }}";
        var website_domain          = "{{ $setting_result['website_domain'] or '' }}";
    </script>
    @include('frontend.common.custom-code-header')
</head>
<body>
    @yield('content')
    @include('frontend.common.popup-modal-landingpage-contact')
    <script>{!! file_get_contents( asset("$path_public_landingpage/theme.min.js") ) !!}</script>
    @yield('js_popup_register')
    @include('frontend.common.custom-code-header')
</body>
</html>