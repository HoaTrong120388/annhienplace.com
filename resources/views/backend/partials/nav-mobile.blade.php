<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        @include('backend.partials.nav-content', ['tagPcNav' => ''])
    </ul>
</div>
<!-- END: Mobile Menu -->