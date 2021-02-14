<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <base href="{{ asset('public/backend') }}/">
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login - Midone - Tailwind HTML Admin Template</title>

        <!-- BEGIN: CSS Assets-->
        <link href="{{ asset('public/backend/dist/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/backend/dist/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="dist/css/app.css" />
        <!-- END: CSS Assets-->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        {!! FCommon::minifycss('backend_theme') !!}
    </head>
    <!-- END: Head -->
    <body class="login">
