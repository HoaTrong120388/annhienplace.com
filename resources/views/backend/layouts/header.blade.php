<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <base href="{{ asset('public/backend') }}/">
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="HOATANG">
        <title>{{ $titlePage }}</title>
        <!-- BEGIN: CSS Assets-->
        <link href="{{ asset('public/backend/dist/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/all/plugin/jquery-confirm/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/dist/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/backend/dist/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="dist/css/app.css" />

        <!-- END: CSS Assets-->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>

        <script>
            var path_public             = "{{ asset('public') }}";
            var website_domain          = "{{ $setting_result['website_domain'] ?? '' }}";
            var website_domain_admin    = "{{ $setting_result['website_domain_admin'] ?? '' }}";
            var website_domain_api      = "{{ $setting_result['website_domain_api'] ?? '' }}";
        </script>
        {!! FCommon::minifycss('backend_theme') !!}
        @yield('headerstyle')
    </head>
    <!-- END: Head -->
    <body class="app">