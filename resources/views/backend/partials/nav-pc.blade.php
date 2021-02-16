<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> WLM<span class="font-medium"> Admin</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        @include('backend.partials.nav-content', ['tagPcNav' => 'side-']);
    </ul>
</nav>
<!-- END: Side Menu -->