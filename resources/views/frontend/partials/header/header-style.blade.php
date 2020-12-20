<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/bootstrap.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/animate.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/font-awesome.min.css') }}" />

<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/furniture-icons.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/linear-icons.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/linear-icons.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/magnific-popup.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('public/frontend/css/theme.css') }}" />

<!--Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

{!! FCommon::minifycss('frontend_theme') !!}
@yield('custom_css')