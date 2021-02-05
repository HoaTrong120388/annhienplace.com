<script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.owl.carousel.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.ion.rangeSlider.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.isotope.pkgd.js') }}"></script>

<script src="{{ asset('public/all/plugin/mega-menu/jquery/jquery.appear.min.js') }}"></script>
<script src="{{ asset('public/all/plugin/mega-menu/jquery/jquery.easing.min.js') }}"></script>
<script src="{{ asset('public/all/plugin/mega-menu/jquery/jquery.cookie.min.js') }}"></script>
<script src="{{ asset('public/all/plugin/mega-menu/jquery/jquery.common.min.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

<script src="{{ asset('public/all/plugin/bootstrap//js/bootstrap.min.js') }}"></script>
        
<!-- WLC Javascript Files -->
<script src="{{ asset('public/all/plugin/mega-menu/js/menu.min.js') }}"></script>
<script src="{{ asset('public/all/plugin/mega-menu/js/menu.init.min.js') }}"></script>


<script src="{{ asset('public/frontend/js/main.js') }}"></script>

@yield('footerjs')
{!! FCommon::minifyjs('frontend_theme') !!}
@include('flash::message')
@yield('custom_js')