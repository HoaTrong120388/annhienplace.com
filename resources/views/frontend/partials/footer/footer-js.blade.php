<script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.bootstrap.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.owl.carousel.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.ion.rangeSlider.js') }}"></script>
<script src="{{ asset('public/frontend/js/jquery.isotope.pkgd.js') }}"></script>
<script src="{{ asset('public/frontend/js/main.js') }}"></script>

@yield('footerjs')
{!! FCommon::minifyjs('frontend_theme') !!}
@include('flash::message')
@yield('custom_js')