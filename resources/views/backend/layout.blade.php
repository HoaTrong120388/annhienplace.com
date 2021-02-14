@include('backend.layouts.header')
@include('backend.partials.nav-mobile')
<div class="flex">
    @include('backend.partials.nav-pc')
    <!-- BEGIN: Content -->
    <div class="content">
        @include('backend.partials.top-bar')
        @yield('content')
    </div>
    <!-- END: Content -->
</div>
@include('backend.layouts.footer')
        
        
        