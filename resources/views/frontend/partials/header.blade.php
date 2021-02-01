<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    @include('frontend.partials.header.header-meta-seo')
    @include('frontend.partials.header.header-style')

    <script>
        var path_public             = "{{ asset('public') }}";
        var path_upload             = "{{ asset('upload') }}";
        var website_domain          = "{{ $setting_result['website_domain'] or '' }}";
    </script>

</head>

<body>
    <div class="page-loader"></div>
    <div class="wrapper">
        @include('frontend.partials.header.mega-nav')