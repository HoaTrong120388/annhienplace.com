<link rel="stylesheet" media="all" href="{{ asset('public/all/plugin/bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/animate.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/font-awesome.min.css') }}" />

<!-- WLC Stylesheet Files -->
<link rel="stylesheet" href="{{ asset('public/all/plugin/mega-menu/css/menu.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/all/plugin/mega-menu/css/menu-skin.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/all/plugin/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
<!-- WLC Skin Stylesheet Files -->
		
<link rel="stylesheet" media="all" href="{{ asset('public/all/plugin/jquery-confirm/jquery-confirm.min.css') }}">
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/furniture-icons.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/linear-icons.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/magnific-popup.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/theme.css') }}?v=0.1" />

<!--Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

@yield('headerstyle')
{!! FCommon::minifycss('frontend_theme') !!}
@yield('custom_css')